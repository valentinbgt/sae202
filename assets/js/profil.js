const pictureInput = document.getElementById("profilPictureInput");
const addPictureButton = document.getElementById("addPictureButton");
const picturePreview = document.getElementById("profilImage");

addPictureButton.addEventListener("click", () => {
    pictureInput.click();
})
picturePreview.addEventListener("click", () => {
    pictureInput.click();
})

pictureInput.addEventListener("change", () => {
    const file = pictureInput.files[0];
    picturePreview.src = URL.createObjectURL(file);
    picturePreview.hidden = false;
})