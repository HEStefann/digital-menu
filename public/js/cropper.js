const inputImage = document.getElementById("inputImage");
const labelInputImage = document.getElementById("labelInputImage");
const preview = document.getElementById("preview");
const cropButton = document.getElementById("cropButton");
let cropper;

inputImage.addEventListener("change", function (event) {
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function (e) {
            const image = document.createElement("img");
            image.src = e.target.result;

            preview.innerHTML = "";
            preview.appendChild(image);

            if (cropper) {
                cropper.destroy();
            }

            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                dragMode: "move",
                autoCropArea: 1,
                cropBoxResizable: true,
                cropBoxMovable: true,
                zoomable: true,
                zoomOnTouch: true,
                zoomOnWheel: true,
                movable: true,
                background: true,
                modal: true,
            });
        };

        reader.readAsDataURL(file);
    }
});

cropButton.addEventListener("click", function () {
    if (cropper) {
        const canvas = cropper.getCroppedCanvas();
        const roundedCanvas = getRoundedCanvas(canvas);
        const dataURL = roundedCanvas.toDataURL();
        document.getElementById("hiddenLogoInput").value = dataURL;
        labelInputImage.innerHTML= "change";
        document.getElementById("selectedImg").src = dataURL;
    }
});

function getRoundedCanvas(sourceCanvas) {
    const canvas = document.createElement("canvas");
    const context = canvas.getContext("2d");
    const width = sourceCanvas.width;
    const height = sourceCanvas.height;

    canvas.width = width;
    canvas.height = height;

    context.imageSmoothingEnabled = true;
    context.drawImage(sourceCanvas, 0, 0, width, height);
    context.globalCompositeOperation = "destination-in";
    context.arc(width / 2, height / 2, Math.min(width, height) / 2, 0, 2 * Math.PI, true);
    context.fill();

    return canvas;
}
