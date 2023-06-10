const motorcyclesListJSON =
  document.querySelector('#motorcyclesList').textContent
const websiteRoot = document.querySelector('#websiteRoot').textContent
const searchInput = document.querySelector('#search')

const motorcycleListDOM = document.querySelector('.motorcycle__list')

const motorcyclesList = JSON.parse(motorcyclesListJSON)
const url = window.location.href

document.addEventListener('readystatechange', e => {
  if (e.target.readyState === 'complete') {
    removeAllChildren(motorcycleListDOM)
    createMotorcycleList(motorcycleListDOM, motorcyclesList)
  }
})

searchInput.addEventListener('keyup', e => {
  const result = motorcyclesList.filter(
    motorcycle =>
      motorcycle.make.toLowerCase().includes(e.target.value.toLowerCase()) ||
      motorcycle.model.toLowerCase().includes(e.target.value.toLowerCase())
  )

  list = e.target.value.trim().length === 0 ? motorcyclesList : result
  removeAllChildren(motorcycleListDOM)
  createMotorcycleList(motorcycleListDOM, list)
})

const createMotorcycleList = (DOMList, _list) => {
  _list.forEach(motorcycle => {
    let editButton
    let deleteButton

    let compareButton
    let detailsButton

    const motorcycleItem = document.createElement('div')
    motorcycleItem.classList.add('motorcycle__item')

    const image = document.createElement('img')
    image.src = websiteRoot + '/' + motorcycle.imagePath
    image.alt = motorcycle.make + ' ' + motorcycle.model + ' image'

    const info = document.createElement('div')
    info.classList.add('motorcycle__info')

    const makeSpan = document.createElement('span')
    makeSpan.textContent =
      motorcycle.make.charAt(0).toUpperCase() + motorcycle.make.slice(1)

    const modelSpan = document.createElement('span')
    modelSpan.textContent =
      motorcycle.model.charAt(0).toUpperCase() + motorcycle.model.slice(1)

    const buttons = document.createElement('div')
    buttons.classList.add('motorcycle__buttons')

    if (url.includes('admin')) {
      editButton = document.createElement('a')
      editButton.classList.add('btn', 'btn--secondary', 'btn--small')
      editButton.href =
        websiteRoot + '/admin/motorcycles?type=edit&id=' + motorcycle.id
      editButton.innerHTML = '<i class="fa-solid fa-pen"></i>Edit'

      deleteButton = document.createElement('button')
      deleteButton.classList.add('btn', 'btn--primary', 'btn--small')
      deleteButton.innerHTML = '<i class="fa-solid fa-trash"></i>Delete'
      deleteButton.addEventListener('click', () => {
        // function from confirmModa.js
        showModal(
          'Delete item',
          'Are you sure you want to delete this item?',
          websiteRoot + '/admin/motorcycles?type=remove&id=' + motorcycle.id
        )
      })
    } else {
      compareButton = document.createElement('button')
      compareButton.classList.add('btn', 'btn--secondary', 'btn--small')
      compareButton.innerHTML = '<i class="fa-solid fa-plus"></i>Compare'
      compareButton.addEventListener('click', () => {
        // function from compareMotorcycles.js
        if (checkIsInIdsList(motorcycle.id)) {
          const buttons = Array.from(
            compareList.querySelectorAll('button')
          ).filter(el => el.textContent === motorcycle.model)
          removeFromComparer(motorcycle.id, buttons[0], compareButton)
          compareButton.innerHTML = '<i class="fa-solid fa-plus"></i>Compare'
        } else {
          addToComparer(motorcycle.id)
          compareButton.innerHTML = '<i class="fa-solid fa-minus"></i>Compare'
        }
      })

      detailsButton = document.createElement('a')
      detailsButton.classList.add('btn', 'btn--secondary', 'btn--small')
      detailsButton.href =
        websiteRoot + '/home/motorcycles?type=details&id=' + motorcycle.id
      detailsButton.innerHTML = '<i class="fa-solid fa-circle-info"></i>Details'
    }

    info.appendChild(makeSpan)
    info.appendChild(modelSpan)
    if (url.includes('admin')) {
      buttons.appendChild(editButton)
      buttons.appendChild(deleteButton)
    } else {
      buttons.appendChild(compareButton)
      buttons.appendChild(detailsButton)
    }
    motorcycleItem.appendChild(image)
    motorcycleItem.appendChild(info)
    motorcycleItem.appendChild(buttons)
    DOMList.appendChild(motorcycleItem)
  })
}

const removeAllChildren = element => {
  while (element.firstChild) {
    element.removeChild(element.firstChild)
  }
}
