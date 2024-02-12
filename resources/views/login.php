<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion Admin</title>
</head>
<body>
  <h1>Connexion Admin</h1>
  <form action="/admin/login" method="POST">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="EMAIL" required><br>
    <label for="password">Mot de passe:</label>
    <input type="password" id="password" name="password" placeholder="MDP" required><br>
    <button type="submit">Se connecter</button>
  </form>
</body>
</html>
