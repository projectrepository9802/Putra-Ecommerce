$("#psw-show").on("click", () => {
  const inputType = $("#password-input-1")[0]["attributes"][0]["value"];

  if (inputType == "password") {
    $("#password-input-1").attr("type", "text");
    $("#psw-show").html("<span class='fas fa-eye-slash'></span>");
  } else {
    $("#password-input-1").attr("type", "password");
    $("#psw-show").html("<span class='fas fa-eye'></span>");
  }
});

$("#retypepsw-show").on("click", () => {
  const inputType = $("#password-input-2")[0]["attributes"][0]["value"];

  if (inputType == "password") {
    $("#password-input-2").attr("type", "text");
    $("#retypepsw-show").html("<span class='fas fa-eye-slash'></span>");
  } else {
    $("#password-input-2").attr("type", "password");
    $("#retypepsw-show").html("<span class='fas fa-eye'></span>");
  }
});
