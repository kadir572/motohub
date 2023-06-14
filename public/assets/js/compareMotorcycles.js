const compareList = document.querySelector('.compare__list')
const compareBtn = document.querySelector('.compare__btn')

// motorcyclesList taken from motorcyclesFilter.js

const idsList = []
const compareBtnHref = compareBtn.href + '&'

document.addEventListener('readystatechange', e => {
  if (e.target.readyState === 'complete') {
    toggleButton(false, compareBtn)
  }
})

const addToComparer = (id, motorcycleCompareBtn) => {
  if (idsList.length >= 4) return
  if (!idsList.includes(id)) {
    idsList.push(id)
    motorcycleCompareBtn.innerHTML = '<i class="fa-solid fa-minus"></i>Compare'
    const motorcycle = motorcyclesList.find(motorcycle => motorcycle.id === id)
    const name = motorcycle.model
    const btn = createTagButton(name, motorcycle.id)
    addTagButtonToDOM(btn)
    const href = generateHrefFromList(compareBtnHref, idsList)
    compareBtn.href = href

    if (idsList.length >= 2) toggleButton(true, compareBtn)
  }
}

const removeFromComparer = (id, btn, motorcycleCompareBtn) => {
  const index = idsList.indexOf(id)
  if (index > -1) idsList.splice(index, 1)
  btn.remove()
  motorcycleCompareBtn.innerHTML = '<i class="fa-solid fa-plus"></i>Compare'
  const href = generateHrefFromList(compareBtnHref, idsList)
  compareBtn.href = href

  if (idsList.length < 2) toggleButton(false, compareBtn)
}

const createTagButton = (name, id) => {
  const btn = document.createElement('button')
  btn.classList.add('btn', 'btn--secondary', 'btn--small')
  btn.innerHTML = '<i class="fa-solid fa-x"></i>' + name
  btn.addEventListener('click', () => {
    const compareBtn = getCompareBtnByMotorcycleName(name)
    removeFromComparer(id, btn, compareBtn)
  })
  return btn
}

const addTagButtonToDOM = btn => {
  compareList.appendChild(btn)
}

const toggleButton = (bool, btn) => {
  if (bool) {
    btn.classList.remove('compare__btn--disabled')
  } else {
    btn.classList.add('compare__btn--disabled')
  }
}

const generateHrefFromList = (href, list) => {
  list.forEach((val, i) => {
    href += 'id' + (i + 1) + '=' + val
    if (i < list.length - 1) href += '&'
  })

  return href
}

const checkIsInIdsList = id => {
  const index = idsList.indexOf(id)
  return index > -1 ? true : false
}

const getCompareBtnByMotorcycleName = name => {
  const motorcycleItems = document.querySelectorAll('.motorcycle__item')
  let motorcycleItem
  motorcycleItems.forEach(item => {
    if (item.childNodes[1].childNodes[1].textContent.toLowerCase() === name)
      motorcycleItem = item
  })

  return motorcycleItem.childNodes[2].childNodes[0]
}
