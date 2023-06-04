const fileInput = document.querySelector('#imageUpload')
const fileInputLabel = document.querySelector('#imageUploadLabel span')
// const imageUploadText = document.querySelector('#imageUploadText')
const imageUploadImg = document.querySelector('#imageUploadImg')
console.log(fileInput.files)
fileInputLabel.textContent = 'Choose a file'
// imageUploadText.textContent = 'No file chosenn'

fileInput.addEventListener('change', () => {
  if (FileReader && fileInput.files && fileInput.files.length) {
    const fr = new FileReader()
    fr.onload = () => {
      imageUploadImg.src = fr.result
    }
    fr.readAsDataURL(fileInput.files[0])
  }
  console.log(fileInput.files)
  fileInputLabel.textContent = fileInput.files[0].name
})
