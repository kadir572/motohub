const confirmModal = document.querySelector('.confirm__modal')
const confirmModalTitle = document.querySelector('.confirm__modal h2')
const confirmModalQuestion = document.querySelector('.confirm__modal span')
const confirmModalPositive = document.querySelector('.confirm__modal a')
const confirmModalPositiveSpan = document.querySelector(
  '.confirm__modal a span'
)
const confirmModalNegative = document.querySelector(
  '.confirm__modal button span'
)

const showModal = (title, question, yesUrl, yesText = 'Yes', noText = 'No') => {
  confirmModalTitle.textContent = title
  confirmModalQuestion.textContent = question
  confirmModalPositiveSpan.textContent = yesText
  confirmModalPositive.href = yesUrl
  confirmModalNegative.textContent = noText
  confirmModal.classList.add('confirm__modal--show')
}

const hideModal = () => {
  confirmModal.classList.remove('confirm__modal--show')
}
