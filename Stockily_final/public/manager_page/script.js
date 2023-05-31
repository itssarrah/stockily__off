var input = document.getElementById("image-input");
var output = document.getElementById("sec__photo__container");
input.addEventListener("change", function () {
  if (input.files[0]) {
    var reader = new FileReader();
    reader.addEventListener("load", function () {
      console.log(reader.result);
      output.src = reader.result;
      output.style.backgroundColor = "transparent";
    });
    reader.readAsDataURL(input.files[0]);
  }
});
