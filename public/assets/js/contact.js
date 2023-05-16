const select = document.querySelector('select')

select.classList.add('select__unselected')

select.addEventListener('focus', () => {
  console.log('focused')
  select.classList.remove('select__unselected')
})

select.addEventListener('blur', () => {
  if (select.value === '') {
    select.classList.add('select__unselected')
  } else {
    select.classList.remove('select__unselected')
  }
})
