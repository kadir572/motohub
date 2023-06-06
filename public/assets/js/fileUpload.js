const fileInput = document.querySelector('#imageUpload')
const fileInputLabel = document.querySelector('#imageUploadLabel span')
const fileUploadImg = document.querySelector('#imageUploadImg')

fileInputLabel.textContent = 'Choose a file'
fileInput.classList.add('form__input--hidden')

fileInput.addEventListener('change', () => {
  if (FileReader && fileInput.files && fileInput.files.length) {
    const fr = new FileReader()
    fr.onload = () => (fileUploadImg.src = fr.result)
    fr.readAsDataURL(fileInput.files[0])
  }
  fileInputLabel.textContent = fileInput.files[0].name
})
