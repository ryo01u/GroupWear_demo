var login_bg = function(w,h){

    // var canvasWidth = window.outerWidth;
    // var canvasHeight = window.outerHeight;
    var canvasWidth = w;
    var canvasHeight = h;

    //ステージオブジェクトをつくる
    var stage = new createjs.Stage("myCanvas");
    var canvas = document.getElementById("myCanvas");
    // canvas.style.width = document.querySelector("html").offsetWidth + "px";
    // canvas.style.height = document.querySelector("html").offsetHeight - document.querySelector(".bass_header_01").offsetHeight - document.querySelector(".bass_nav_01").offsetHeight + "px";
    // console.log( window.outerHeight);

    //キャンバスのサイズをウインドウのサイズと同じにする
    // canvas.width = document.body.clientWidth;
    // canvas.height = document.body.clientHeight;
    canvas.width = canvasWidth;
    canvas.height = canvasHeight;
    // canvas.style.top = document.querySelector(".bass_header_01").offsetHeight +document.querySelector(".bass_nav_01").offsetHeight + "px";
    //キャンバスタグの幅と高さ、それぞれの半分の値を変数に格納
    var canvasHalfWidth = canvas.width / 2;
    var canvasHalfHeight = canvas.height / 2;

    var baseRadius = canvas.width / 30; //キャンバスの幅の二十分の一のサイズ

    if (canvas.width <= 480) {
        var baseRadius = canvas.width / 15;
    }
    if (canvas.width <= 960) {
        var baseRadius = canvas.width / 25;
    }


    //コンテナ
    console.log(canvasHeight)
    var mainContainer = new createjs.Container();
    mainContainer.x = 0;
    mainContainer.y = 0;
    //基準点を画面の真中にする
    mainContainer.regX = -1 * canvasHalfWidth;
    mainContainer.regY = -1 * canvasHalfHeight;
    stage.addChild(mainContainer);


    //ar bgRectContainer01 = new createjs.Container();
    //mainContainer.addChildAt(bgRectContainer01,1);

    function bgFirst() {
        bgRect01 = qDrawRect(0, 0, canvasWidth, canvasHeight);
        bgRect01.alpha = 1;
        mainContainer.addChild(bgRect01);
        mainContainer.addChildAt(bgRect01, 1);
    }

    //bgFirst();


    function qDrawText(moji) {
        var text = new createjs.Text(moji, "10px Century Gothic", "#FFFFFF");
        //var text = new createjs.Text(moji,"10px sans-serif","#FFFFFF");
        text.x = 0;
        text.y = 0;
        return text;
    }

    for (i = 0; i < 25; i++) {
        var randX = Math.floor(Math.random() * canvas.width) - canvas.width / 2;
        var randY = Math.floor(Math.random() * canvas.height) - canvas.height / 2;
        //var randWH = Math.floor(baseRadius * Math.random() + baseRadius / 2);
        var textObj = qDrawText("gigno system japan");
        textObj.x = randX;
        textObj.y = randY;
        textObj.regX = textObj.getMeasuredWidth() / 2;
        textObj.regY = textObj.getMeasuredHeight() / 2;
        textObj.alpha = 0;
        mainContainer.addChild(textObj);
        mainContainer.addChildAt(textObj, 5);
        var time = Math.floor(Math.random() * 4000) + 500;

        //createjs.Tween.get(textObj,{loop:true}).wait(time).to({alpha:0.5},1000).to({alpha:0,scaleX:3,scaleY:3},4000,createjs.Ease.quartInOut).to({alpha:0.1});

        var moveRandom = Math.floor(Math.random() * 4);

        if (moveRandom == 0) {
            createjs.Tween.get(textObj, {
                loop: true
            }).wait(time).to({
                alpha: 0.3
            }, 1000).to({
                x: randX * 1.5,
                alpha: 0
            }, 5000);
        } else if (moveRandom == 1) {
            createjs.Tween.get(textObj, {
                loop: true
            }).wait(time).to({
                alpha: 0.3
            }, 1000).to({
                y: randY * 1.5,
                alpha: 0
            }, 5000);
        } else if (moveRandom == 2) {
            createjs.Tween.get(textObj, {
                loop: true
            }).wait(time).to({
                alpha: 0.3
            }, 1000).to({
                x: randX * -1.5,
                alpha: 0
            }, 5000);
        } else {
            createjs.Tween.get(textObj, {
                loop: true
            }).wait(time).to({
                alpha: 0.3
            }, 1000).to({
                y: randY * -1.5,
                alpha: 0
            }, 5000);
        }


    }

    function qDrawRect(x, y, width, height) {
        var g = new createjs.Graphics();

        var rColor;
        var gColor;
        var bColor;

        var randColor = Math.floor(Math.random() * 4);

        if (randColor == 0) {
            var rColor = 135;
            var gColor = 135 + Math.floor(Math.random() * 121);
            var bColor = 135 + Math.floor(Math.random() * 121);
        } else if (randColor == 1) {
            var rColor = 135 + Math.floor(Math.random() * 121);
            var gColor = 135;
            var bColor = 135 + Math.floor(Math.random() * 121);
        } else if (randColor == 2) {
            var rColor = 135 + Math.floor(Math.random() * 121);
            var gColor = 135 + Math.floor(Math.random() * 121);
            var bColor = 135;
        } else if (randColor == 3) {
            var rColor = 239;
            var gColor = 134;
            var bColor = 98;
        }

        var color = "rgba(" + rColor + "," + gColor + "," + bColor + ",1)";

        //console.log(color);
        //g.beginFill("rgba(r,g,b,0.1)");
        g.beginFill(color);
        g.setStrokeStyle(1);
        g.drawRect(x, y, width, height);
        var s = new createjs.Shape(g);
        s.regX = width / 2;
        s.regY = height / 2;
        s.width = width;
        s.height = height;
        return s;
    }

	for(i=0;i<150;i++){
	  var randX = Math.floor(Math.random()*canvas.width) - canvas.width / 2;
	  var randY = Math.floor(Math.random()*canvas.height) - canvas.height / 2;
	  var randWH = Math.floor(baseRadius * Math.random() + baseRadius / 3);
	  var rect = qDrawRect(randX,randY,randWH,randWH);
	  rect.alpha = 0;
	  mainContainer.addChildAt(rect,5);
	  var time = Math.floor(Math.random()*4000) + 500;

	  createjs.Tween.get(rect,{loop:true}).wait(time).to({alpha:0.2},1000).to({alpha:0,scaleX:4,scaleY:4},4000,createjs.Ease.quartInOut)
	                                                .to({alpha:0.1});
	}


    createjs.Ticker.setFPS(20);
    createjs.Ticker.addEventListener('tick', tickHandler);

    function tickHandler(event) {
        stage.update();
    }

    //直線を描画する関数
    function qDrawLine(x, y, toX, toY, lineWidth, color) {
        var shape = new createjs.Shape();
        shape.graphics.setStrokeStyle(lineWidth);
        shape.graphics.beginStroke(color);
        shape.graphics.moveTo(x, y);
        shape.graphics.lineTo(toX, toY);
        shape.graphics.endStroke();

        shape.alpha = 0;
        mainContainer.addChild(shape);

        shape.positionX = x;
        shape.positionY = y;
        shape.positionToX = toX;
        shape.positionToY = toY;

        return shape;
    }


    //縦線
    for (i = 0; i < 30; i++) {
        var x = Math.floor(Math.random() * canvas.width) - canvas.width / 2;
        var toX = x;
        var y = -1 * canvas.height / 2;
        var toY = canvas.width;
        var lineWidth = Math.floor(Math.random() * 5);
        var line = qDrawLine(x, y, toX, toY, 1, "#FFF");
        line.alpha = 0;
        mainContainer.addChild(line);
        mainContainer.addChildAt(line, 1);
        qAppearObject20(line);
    }

    //横線
    for (i = 0; i < 30; i++) {
        var x = -1 * canvas.width / 2;
        var toX = canvas.width;
        var y = Math.floor(Math.random() * canvas.height) - canvas.height / 2;
        var toY = y;
        var lineWidth = Math.floor(Math.random() * 5);
        var line = qDrawLine(x, y, toX, toY, 1, "#FFF");
        line.alpha = 0;
        mainContainer.addChild(line);
        mainContainer.addChildAt(line, 1);
        qAppearObject20(line);
    }


    var firstInfo = {};
    //firstInfo.name = "Cytokinesis";
    firstInfo.name = "Qrater";
    firstInfo.color = "#ef6262";
    //最初の円を描画
    var firstCircleTextList = new QdrawCircleAndText(0, 0, baseRadius * 1, firstInfo);
    var mainCircle = firstCircleTextList[0];
    mainContainer.addChild(mainCircle);
    mainContainer.addChildAt(mainCircle, 500);

    //円に情報を加える
    mainCircle.objInfo = circleList;

    var mainText = firstCircleTextList[1];
    mainContainer.addChild(mainText);
    mainContainer.addChildAt(mainText, 501);


    //対象を1300ミリ秒かけて出現させる
    function qAppearObject(obj) {
        createjs.Tween.get(obj, {
            loop: false
        }).to({
            alpha: 0.4
        }, 1300);
    }

    //対象を1300ミリ秒かけて出現させる
    function qAppearObjectMax(obj) {
        createjs.Tween.get(obj, {
            loop: false
        }).to({
            alpha: 1.0
        }, 1300);
    }

    //対象を1300ミリ秒かけて出現させる
    function qAppearObject20(obj) {
        createjs.Tween.get(obj, {
            loop: false
        }).to({
            alpha: 0.15
        }, 1300);
    }

    stage.update();

}
var addEvent = function(element, eventName, fn) {
  if (element.addEventListener) {
    element.addEventListener(eventName, fn, false);
  } else if (element.attachEvent) {
    element.attachEvent('on' + eventName, fn);
  }
};
(function(){
addEvent(window, 'load', function() {
w = document.getElementsByTagName("html")[0].clientWidth;
h = document.getElementsByTagName("html")[0].clientHeight;
login_bg(w,h);
var myCanvas = document.getElementById("myCanvas");
myCanvas.width = w;
myCanvas.height = h;

})    
})()
