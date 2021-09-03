function addEmptyPreviewText() {
    const preview = document.querySelector('#preview-photos');
    const span = document.createElement("span");
    span.innerHTML = 'Carica foto';
    span.id = 'empty-preview-text';
    preview.appendChild(span);
}

function deletePhotos() {
    const upload = document.querySelector('#photos');
    const allPhotos = document.getElementsByClassName('preview-box');
    while (allPhotos.length > 0) {
        for (let photo of allPhotos) {
            photo.remove();
        }
        upload.value = "";
    }
    addEmptyPreviewText();
}

function previewPhotos() {

    var fileList = [];

    if (this.files) {
        const span = document.querySelector('#empty-preview-text');
        const allPhotos = document.getElementsByClassName('preview-box');
        
        if (span){
            span.remove();
        }
        fileList = Array.from(this.files);
        fileList.forEach(readAndPreview);

        if (this.files.length > (15 - allPhotos.length)) {
            alert("Puoi caricare massimo 15 foto!");
            deletePhotos();
        }
    }     
  
    function readAndPreview(file) {  
      
        if (!/\.(jpe?g|png|bmp|gif|webp)$/i.test(file.name)) {
            return alert(file.name + " non e' una immagine valida!");
        } 
        
        var reader = new FileReader();
        
        reader.addEventListener("load", function() {
            const preview = document.querySelector('#preview-photos');
            const box = document.createElement("div");
            const photo = new Image();
            const reset = document.querySelector('#reset-upload');             

            box.className = 'preview-box';
            photo.className = 'preview-photo';
            photo.title = file.name;
            photo.src = this.result;
            
            preview.appendChild(box);
            box.appendChild(photo);

            reset.onclick = e => { 
                e.preventDefault();
                deletePhotos();
            };
        });
        
        reader.readAsDataURL(file);
    }  
} 

window.onload = () => {
    addEmptyPreviewText();
    document.querySelector('#photos').addEventListener("change", previewPhotos);
};