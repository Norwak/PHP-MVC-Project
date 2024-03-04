<h1>New Product</h1>

<form method="POST" action="/products/create">

  <label for="name">Name</label>
  <input type="text" id="name" name="name">

  <?php if (isset($errors['name'])) { ?>
    <p><?=$errors['name']?></p>
  <?php } ?>

  <label for="description">Desctiprion</label>
  <textarea type="text" id="description" name="description"></textarea>

  <button type="submit">Save</button>

</form>