document.getElementById("profile_update_button").onclick = (e) => {
  e.preventDefault();
  var formData = {
    age: $("#age").val(),
    dob: $("#dob").val(),
    contact: $("#contact").val(),
  };
  $.ajax({
    method: "POST",
    url: "http://localhost/login/php/profile_handler_mongo.php",
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
