const pictureInput = document.getElementById("jardinPicture");
const addPictureButton = document.getElementById("addPicture");
const picturePreview = document.getElementById("picturePreview");

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