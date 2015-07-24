var json_old3 = 0;

function setImage(imgName, num, id){
	for (var i = 0; i < num; i++) {
		var img = document.createElement("IMG");
		img.setAttribute("src", "images/"+imgName+".png");
		img.setAttribute("alt", "faceIcon");
		document.getElementById(id).appendChild(img);
	}
}

function setRetroCard(panel){
	for (var i = 0; i < panel.length; i++) {
		var card = document.createElement("div");
		card.setAttribute("class", "panel panel-default");
		card.setAttribute("id", "card"+(i+1));

		var paraTopic = document.createElement("P");
		var topic = document.createTextNode(panel[i]);
		paraTopic.appendChild(topic);
		card.appendChild(paraTopic);

		var paraAction = document.createElement("P");
		var action = document.createTextNode("Action Item");
		paraAction.appendChild(action);
		card.appendChild(paraAction);

		var paraOwner = document.createElement("P");
		var owner = document.createTextNode("Owner");
		paraOwner.appendChild(owner);
		card.appendChild(paraOwner);

		document.getElementById("retroCard").appendChild(card);
	}
}

function retrospective(SQUAD_ID){
    $.getJSON(
        'php/queryRetro.php',{'SQUAD_ID':SQUAD_ID},function(json) {
            if(json_old3 != JSON.stringify(json)){
                json_old3 = JSON.stringify(json);
				setImage("icon4", json.POSITIVE, "positive");
				setImage("icon4", json.NEUTRAL, "neutral");
				setImage("icon4", json.STRESSFUL, "stressful");

				setRetroCard(json.PANEL_CONTENT);
				// console.log(json.PANEL_CONTENT);
						
			}
		}
	);
}
