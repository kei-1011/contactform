<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>input</title>
</head>
<body>

        <form method="post" action="<?php echo h($_SERVER['REQUEST_URI']); ?>">
          <input type="hidden" name="action" value="confirm">
          <input type="hidden" name="token" value="<?php echo $token; ?>">

<?php if(isset($errors) && $errors){ ?>
<div class="error">
  <?php foreach($errors as $error){ ?>
  <p><?php echo $error; ?></p>
  <?php } ?>
</div>
<?php } ?>
<?php
$f = "";
if(isset($form_data) && $form_data){
   $f = $form_data;
}
?>

        <table>
          <tr>
            <th>name</th>
            <td><input type="text" name="name" value="<?php show('name',$f); ?>"></td>
          </tr>
          <tr>
            <th>email</th>
            <td><input type="text" name="email" value="<?php show('email',$f); ?>"></td>
          </tr>
          <tr>
            <th>message</th>
            <td><textarea name="message"><?php show('message',$f); ?></textarea></td>
          </tr>
        </table>

        <p class="btn">
          <button>next</button>
        </p>

        </form>

</body>
</html>

