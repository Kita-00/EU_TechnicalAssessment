function searcHierarchy() {
    let input;
    let lowerInput;
    let cards;
    let cardContainer;
    let empNum;
    let j;
    let i;

    input = document.getElementById("HierarchySearch");
    lowerInput = input.value.toLowerCase();
    cardContainer = document.getElementsByName("cContainer");
                
    for (j = 0; j < cardContainer.length; j++) {
        cards = cardContainer[j].getElementsByClassName("card");
        for (i = 0; i < cards.length; i++) {
            empNum = cards[i].querySelector(".card-title");
            if (empNum.innerText.toLowerCase().indexOf(lowerInput) > -1) {
                cards[i].style.display = "";
            } else {
                cards[i].style.display = "none";
            }
        }
    }
}