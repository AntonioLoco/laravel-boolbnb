const inputImg = document.getElementById("cover_image");
const imgPrev = document.getElementById("image_preview");

if (inputImg && imgPrev) {
    inputImg.addEventListener("change", function () {
        const uploadedImg = this.files[0];

        if (uploadedImg) {
            const reader = new FileReader();

            reader.addEventListener("load", function () {
                imgPrev.src = reader.result;
            });

            reader.readAsDataURL(uploadedImg);
        }
    });
}