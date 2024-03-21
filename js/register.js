document.getElementById("register_button").onclick = (e) => {
  e.preventDefault();
  var formData = {
    name: $("#name").val(),
    email: $("#email").val(),
    password1: $("#password1").val(),
    password2: $("#password2").val(),
  };
  localStorage.setItem("name", $("#name").val());
  $.ajax({
    method: "POST",
    url: "http://localhost/login/php/register_handler.php",
    data: formData,
    dataType: "json",
  })
    .done(function (data) {
      if (data.success) {
        window.location.href = "http://localhost/login/php/homepage.php";
      } else {
        console.log(data.message);
      }
    })
    .fail((xhr, status, error) => {
      window.location.href = "http://localhost/login/php/homepage.php";
      console.log(xhr.responseText);
    });
};
