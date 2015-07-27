var pageRetro = 0;
var countPage = 0;
var countPageUpdate = 1;
var runnerButton = 1;
function setButtonPage(){
    $.get("php/QueryCountCard.php",{'SQUAD_ID':$SQUAD_ID},function(count){
            countPageUpdate = Math.ceil(count/4.0);
            for(var i = countPage;i<countPageUpdate;i++){
                var button = document.createElement("div");
                button.setAttribute("class","pagination__dot" + ((i==0)? " pagination__dot--active":""));
                button.setAttribute("id","button" + i);
                button.setAttribute("onclick","setPageRetroClick(this," + i + ")");
                var pagination = document.getElementsByClassName("pagination");
                pagination[0].appendChild(button);
            }
            if(countPage < countPageUpdate){
                countPage = countPageUpdate;
            }
            else if(countPage > countPageUpdate){
                for(var i = countPage;i>countPageUpdate;i--){
                    $("#button"+(i-1)).remove();
                }
                countPage = countPageUpdate;
                runnerButton = 0;
                setPageRetro();
            }
        }
    );
}

function setPageRetro(){
    pageRetro = runnerButton;
    $(".pagination div").removeClass("pagination__dot--active");
    $("#button" + runnerButton).addClass("pagination__dot--active");
}

function setPageRetroClick(element,page_number){
    pageRetro = page_number;
    runnerButton = page_number;
    $(".pagination div").removeClass("pagination__dot--active");
    $(element).addClass("pagination__dot--active");
}