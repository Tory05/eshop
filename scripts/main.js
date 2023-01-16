//Megpróbáltam modulokkal dolgozni, hogy elkerüljem azt, hogy ay összes szkript egy html oldalon legyen. Ehelyett csak egy fő modult adunk meg

import controller from './GUIcontroller.js';

$(document).ready(function(){
    controller.initGUI();
})


