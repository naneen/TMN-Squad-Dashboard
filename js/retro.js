var json_old3 = 0;

function setImage(imgName, num, id){
	for (var i = 0; i < num; i++) {
		var img = document.createElement("IMG");
		img.setAttribute("src", "images/"+imgName+".png");
		img.setAttribute("alt", "faceIcon");
		document.getElementById(id).appendChild(img);
	}
}

function setRetroCard(panel, action, owner){
	for (var i = 0; i < panel.length; i++) {
		var card = document.createElement("div");
		card.setAttribute("class", "panel panel-default");
		card.setAttribute("id", "card"+(i+1));

		var headTopic = document.createElement("B");
		var htopic = document.createTextNode("Panel Conrtent : ");
		headTopic.setAttribute("class", "main");
		headTopic.appendChild(htopic);
		card.appendChild(headTopic);

		var paraTopic = document.createElement("p");
		var topic = document.createTextNode(panel[i]);
		paraTopic.setAttribute("class", "normal");
		paraTopic.appendChild(topic);
		card.appendChild(paraTopic);

		var headAction = document.createElement("B");
		var haction = document.createTextNode("Action Item : ");
		headAction.setAttribute("class", "main");
		headAction.appendChild(haction);
		card.appendChild(headAction);

		var paraAction = document.createElement("P");
		var action = document.createTextNode(action[i]);
		paraAction.appendChild(action);
		card.appendChild(paraAction);

		var headOwner = document.createElement("B");
		var howner = document.createTextNode("Owner : ");
		headOwner.setAttribute("class", "main");
		headOwner.appendChild(howner);
		card.appendChild(headOwner);

		var paraOwner = document.createElement("P");
		var owner = document.createTextNode(owner[i]);
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

				setRetroCard(json.PANEL_CONTENT, json.ACTION_ITEM, json.OWNER);
			}
		}
	);
}
