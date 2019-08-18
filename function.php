<?php

function queryPost($mysqli, $sql, $data) {
  // クエリ作成
  $stmt = $mysqli->prepare($sql);
  // SQL文を実行
  if(!$stmt->execute($data)) {
    debug('クエリ失敗しました。');
    debug('失敗したSQL:'.print_r($stmt,true));
    $err_msg['common'] = MSG07;
    return 0;
  }
  debug('クエリ成功');
  return $stmt;
}

function require_logined_session() {
    // ログインしていなければlogin.phpに遷移
  if (!isset($_SESSION["user"])) {
    header('Location: ./login.php');
    exit;
  }
}

function require_unlogined_session() {
  // ログインしていれば
  if (isset($_SESSION["users"])) {
    header('Location: ./index.php');
    exit;
  }
}

function get_current_datetime() {
  $now = new DateTime();
  $now = $now->format('Y-m-d H:i:s');

  return $now;
}

function session_get($key) {
  if (isset($_SESSION[$key])) {
    return $_SESSION[$key];
  }

  return null;
}


function fetch_posts($mysqli) {
  //postsのDBを選択する
  $query = "SELECT
                  posts.post_id,
                  posts.post_user_id,
                  posts.post_content,
                  posts.create_at,

                  users.user_id,
                  users.name
            FROM
                  posts
            LEFT JOIN
                  users
            ON
                  posts.post_user_id = users.user_id
            ORDER BY post_id DESC";

  $result = $mysqli->query($query);

  if(!$result) {
    //エラーが発生した場合
    exit;
  } else {
    if (mysqli_num_rows($result) == 0) {
      //お題が存在しない場合
      exit;
    } else {
      //エラーがない場合
      //連想配列にデータを格納する
      $posts_data = array();
      while ($row = $result->fetch_assoc()) {
        $posts_data[] = $row;
      }
      return $posts_data;
    }
  }
}

//投稿機能
function add_post($add_post, $mysqli) {
  $user_id = $_SESSION['user'];
  $add_post = $mysqli->real_escape_string($add_post);
  $query = "INSERT INTO
                  posts(
                        post_user_id,
                        post_content,
                        create_at
                  )
                  VALUES(
                        $user_id,
                        '$add_post',
                        NOW()
                  )";
  $result = $mysqli->query($query);

  if(!$result) {
    echo 'エラーが発生しました';
  } else {
    echo '投稿しました';
  }
}

function aaa($post_id, $mysqli) {
  // commentsのDBを結合する
  $query = "SELECT
                  comments.comment_id,
                  comments.comment_user_id,
                  comments.comment_post_id,
                  comments.comment_content,
                  comments.create_at,

                  posts.post_id,
                  posts.post_user_id,
                  posts.post_content,

                  users.user_id,
                  users.name
            FROM
                  comments
            LEFT JOIN
                  posts
            ON
                  comments.comment_post_id = posts.post_id
            LEFT JOIN
                  users
            ON
                  comments.comment_user_id = users.user_id
            WHERE
                  comments.comment_post_id = $post_id";

  $result = $mysqli->query($query);
}
function fetch_comments($post_id, $mysqli) {
  // commentsのDBを結合する
  $query = "SELECT
                  comments.comment_id,
                  comments.comment_user_id,
                  comments.comment_post_id,
                  comments.comment_content,
                  comments.create_at,

                  posts.post_id,
                  posts.post_user_id,
                  posts.post_content,

                  users.user_id,
                  users.name
            FROM
                  comments
            LEFT JOIN
                  posts
            ON
                  comments.comment_post_id = posts.post_id
            LEFT JOIN
                  users
            ON
                  comments.comment_user_id = users.user_id
            WHERE
                  comments.comment_post_id = $post_id
            ORDER BY comment_id DESC";

  $result = $mysqli->query($query);

  if (!$result) {
    //エラーが発生した場合
    exit;
  } else {
    //エラーがない場合
    //連想配列にデータを格納する
    $comments_data = array();
    while ($row = $result->fetch_assoc()) {
      $comments_data[] = $row;
    }
    return $comments_data;
  }
}

//コメント投稿機能
function add_comment($post_id, $add_comment, $mysqli) {
  $post_id = $mysqli->real_escape_string($post_id);
  $add_comment = $mysqli->real_escape_string($add_comment);
  $user_id = $_SESSION['user'];

  $query = "INSERT INTO
                  comments(
                        comment_user_id,
                        comment_post_id,
                        comment_content,
                        create_at
                  )
                  VALUES (
                        $user_id,
                        $post_id,
                        '$add_comment',
                        NOW()
                  )";
  $result = $mysqli->query($query);

  if(!$result) {
    echo 'エラーが発生しました';
  } else {
    ?>
    <div class="button">
      <p>口コミを投稿しました</p>
      <a href="comment.php?id=<?php echo $post_id; ?>">戻る</a>
    </div>
<?php  } ?>

<?php  }
//会員登録機能
function save_user($name, $email, $password, $mysqli) {
  $name = $mysqli->real_escape_string($name);
  $email = $mysqli->real_escape_string($email);
  $password = password_hash($password, PASSWORD_DEFAULT);

  $query = "INSERT INTO
                   users(
                        name,
                        email,
                        password
                   )
                  VALUES(
                        '$name',
                        '$email',
                        '$password'
                  )";

  $result = $mysqli->query($query);
  echo "<div class='alert alert-success'>
			<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
			会員登録が完了しました</div>";
}

//ログイン機能
function login_user($email, $password, $mysqli) {
  $email = $mysqli->real_escape_string($email);
  $password = $mysqli->real_escape_string($password);

  $query = "SELECT
                  user_id,
                  name,
                  email,
                  password
            FROM
                  users
            WHERE
                  email = '$email'";
  $result = $mysqli->query($query);

  //パスワード（暗号火済み）とユーザIDの取り出し
  while ($row = $result->fetch_assoc()) {
    $db_hashed_pwd = $row['password'];
    $user_id = $row['user_id'];
  }

  //ハッシュ化されたパスワードがマッチするかどうかを確認
  if (password_verify($password, $db_hashed_pwd)) {
    $_SESSION['user'] = $user_id;
    header("Location:login-out.php");
  } else {
    echo "エラーが発生しました";
  }
}

// 退会機能
function delete($user_id) {
  $user_id = $_SESSION['user'];

  $query = "DELETE FROM users WHERE user_id = '$user_id'";
  $result = $mysqli->query($query);
}

?>
