function doValidate() {
  console.log("Validating...");
  try {
    password = document.getElementById("password").value;
    email = document.getElementById("email").value;
    console.log("Validating email = " + email);
    if (email == null || email == "") {
      alert("Email address is missing");
      return false;
    }
    console.log("Validating password = " + password);
    if (password == null || password == "") {
      alert("Both fields must be filled out");
      return false;
    }
    return true;
  } catch (e) {
    return false;
  }
  return false;
}
