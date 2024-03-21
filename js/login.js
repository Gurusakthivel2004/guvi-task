document.getElementById("login_button").onclick = (e) => {
  e.preventDefault();
  var formData = {
    name: $("#log_email").val(),
    password: $("#log_password").val(),
  };
  console.log(formData);
  $.ajax({
    method: "POST",
    url: "http://localhost/login/php/login_handler.php",
    data: formData,
    dataType: "json",
    encode: true,
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
