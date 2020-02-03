<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>confirm</title>
</head>
<body>


<?php $f = $form_data; ?>

        <table>
          <tr>
            <th>Name</th>
            <td><?php show('name',$f); ?></td>
          </tr>
          <tr>
            <th>E-mail Address</th>
            <td><?php show('email',$f); ?></td>
          </tr>
          <tr>
            <th>Message</th>
            <td><?php echo nl2br(h($f['message'])); ?></td>
          </tr>
        </table>

        <p class="btn">
          <form method="post" action="<?php echo h($_SERVER['REQUEST_URI']); ?>">
            <input type="hidden" name="action" value="back">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <input type="hidden" name="name" value="<?php echo h($f['name']); ?>">
            <input type="hidden" name="email" value="<?php echo h($f['email']); ?>">
            <input type="hidden" name="message" value="<?php echo h($f['message']); ?>">
            <button>back</button>
          </form>

          <form method="post" action="<?php echo h($_SERVER['REQUEST_URI']); ?>">
            <input type="hidden" name="action" value="send">
            <input type="hidden" name="token" value="<?php echo $token; ?>">
            <input type="hidden" name="name" value="<?php echo h($f['name']); ?>">
            <input type="hidden" name="email" value="<?php echo h($f['email']); ?>">
            <input type="hidden" name="message" value="<?php echo h($f['message']); ?>">
            <button>send</button>
          </form>
        </p>


</body>
</html>

