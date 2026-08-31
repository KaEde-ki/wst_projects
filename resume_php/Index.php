<!DOCTYPE html>
<html>
<head>
<title>Resume Form</title>
<style>
  body { font-family: Arial, sans-serif; max-width: 500px; margin: 40px auto; }
  input, textarea { width: 100%; padding: 8px; margin: 6px 0 14px; }
  label { font-weight: bold; }
  button { padding: 10px 20px; }
</style>
</head>
<body>
<h2>Enter Your Resume Details</h2>
<form action="resume.php" method="POST">
  <label>Name</label>
  <input type="text" name="name" required>

  <label>Email</label>
  <input type="text" name="email">

  <label>Phone</label>
  <input type="text" name="phone">

  <label>Summary</label>
  <textarea name="summary" rows="3"></textarea>

  <label>Education</label>
  <textarea name="education" rows="3"></textarea>

  <label>Experience</label>
  <textarea name="experience" rows="3"></textarea>

  <label>Skills (comma separated)</label>
  <input type="text" name="skills">

  <button type="submit">Generate Resume</button>
</form>
</body>
</html>
?>