const orderCategories = {

    cards: document.querySelectorAll('.card-img'),

    init: () => {
        const selectedOrder = document.querySelectorAll('.selected__order');
        for (let selectedOrderElement of selectedOrder) {
            selectedOrderElement.addEventListener('change', orderCategories.handleChangePicture)
        }
    },
    handleChangePicture: (event) => {

        // On récupère le contenu du select cible ainsi que la card à modifier grâce à l'id du select et le titre à changer
        const select = event.currentTarget;
        const selectedText = select.selectedOptions[0].text;
        const selectedLocation = select.id.slice(-1);
        const selectedCard = orderCategories.cards[selectedLocation - 1].closest('div');
        const selectedCategoryTitle = selectedCard.querySelector('.categoryTitle');
        const srcBase = '/assets/images/';

        // Pour chaque cas, on modifie la src de la balise img et le titre de la catégorie
        switch (selectedText) {
            case 'Détente' :
                orderCategories.cards[selectedLocation - 1].src = srcBase + 'detente.jpg';
                selectedCategoryTitle.textContent = selectedText;
                break;
            case 'Au travail' :
                orderCategories.cards[selectedLocation - 1].src = srcBase + 'au-travail.jpg';
                selectedCategoryTitle.textContent = selectedText;
                break;
            case 'Cérémonie' :
                orderCategories.cards[selectedLocation - 1].src = srcBase + 'ceremonie.jpg';
                selectedCategoryTitle.textContent = selectedText;
                break;
            case 'Sortir' :
                orderCategories.cards[selectedLocation - 1].src = srcBase + 'sortir.jpg';
                selectedCategoryTitle.textContent = selectedText;
                break;
            case 'Vintage' :
                orderCategories.cards[selectedLocation - 1].src = srcBase + 'vintage.jpg';
                selectedCategoryTitle.textContent = selectedText;
                break;
            case 'Maisie Hahn' :
                orderCategories.cards[selectedLocation - 1].src = srcBase + 'maisie-hahn.jpg';
                selectedCategoryTitle.textContent = selectedText;
                break;
            case 'Ailen sellers' :
                orderCategories.cards[selectedLocation - 1].src = srcBase + 'ailen-sellers.jpg';
                selectedCategoryTitle.textContent = selectedText;
                break;
            default:
                break;
        }
    }
}

document.addEventListener('DOMContentLoaded', orderCategories.init);
