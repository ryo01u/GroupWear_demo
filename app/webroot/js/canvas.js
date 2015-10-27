/*

//円とテキストを描画する関数
function QdrawCircleAndText(x, y, radiusNum, objInfo)

//displayObjに格納されたものを表示させるための関数
function dispFunc()

//対象を1000ミリ秒かけてアルファ１００％で出現させる関数
function qAppearObjectMax(obj)

最初の円にはlayerプロパティ０を、その子要素には１を。

すべての要素をdisplayObjで管理して表示させる。（円と円の間をつなぐ線・波紋のようなエフェクト・文字の拡大をのぞく)

*/
// window.onload = function() {
window.addEventListener('load', function(e) {
        //     $('#myCanvas').get(0).width = $(window).width();
        //     $('#myCanvas').get(0).height = $(window).height();

    var canvasWidth = null;
    var canvasHeight = null;
    var stage = null;
    var canvas = document.getElementById("myCanvas");

    var canvasHalfWidth = null;
    var canvasHalfHeight = null;
    var resize_fn_canvas = function(){
    var w = document.getElementsByTagName("body")[0].clientWidth;
    // var h_body = document.getElementsByTagName("body")[0].clientHeight;
    var h_body = window.innerHeight;
    var h_header = document.getElementsByClassName("bass_header_01")[0].offsetHeight
    var h_nav = document.getElementsByClassName("bass_nav_01")[0].offsetHeight
    var h = h_body - h_header - h_nav
    var myCanvas = document.getElementById("myCanvas");
    myCanvas.width = w;
    myCanvas.height = h;

    // //画面のサイズを取得
    // var canvasWidth = $(window).width();
    // var canvasHeight = $(myCanvas).height();
    canvasWidth = w;
    canvasHeight = h;

    //ステージオブジェクトをつくる
    stage = new createjs.Stage("myCanvas");
    //マウスオーバーをとらえるための記述
    stage.enableMouseOver();

    //キャンバスのサイズをウインドウのサイズと同じにする
    // var canvas = document.getElementById("myCanvas");
    // canvas.width = document.body.clientWidth;
    // canvas.height = document.body.clientHeight;
    canvas.width = w;
    canvas.height = h;
    //キャンバスタグの幅と高さ、それぞれの半分の値を変数に格納
    canvasHalfWidth = canvas.width / 2;
    canvasHalfHeight = canvas.height / 2;
    }
    resize_fn_canvas()
    if(!window.resize_fn){
    window.resize_fn = new Object()}
    window.resize_fn["canvas"] = function() {
        resize_fn_canvas()
        qDrawBG();
    };



    function qDrawBG() {
        //var stage = new cj.Stage("myCanvas");
        var canvasW = canvasWidth;
        var canvasH = canvasHeight;

        var Graphics = createjs.Graphics;
        var graphics = new Graphics();

        graphics
            // .beginLinearGradientFill(["#000f20", "#00738f"], [0.0, 1.0], 0, 0, 0, canvasHeight)
            .rect(0, 0, canvasW, canvasH)
            .beginFill("rgba(100,0,0,1)")
            .endFill();

        stage.addChild(new createjs.Shape(graphics));
        stage.update();
    }

    qDrawBG();

    var baseRadius = canvas.width / 40; //円の半径の基本的なサイズはキャンバスの幅の40分の1のサイズ

    //円が移動できる限界の領域を指定
    var xLeftLimit = (0 - canvasWidth / 2) + (baseRadius * 4);
    //console.log("xLeftLimit is ==========================="  + xLeftLimit);
    var xRightLimit = (canvasWidth / 2) - (baseRadius * 4);
    var yTopLimit = 0 - (canvasHeight / 2) + (baseRadius * 4);
    //console.log("yTopLimit is ====================  "  + yTopLimit);
    //console.log(canvasHeight);
    var yBottomLimit = (canvasHeight / 2) - (baseRadius * 4);

    //コンテナ
    var mainContainer = new createjs.Container();
    mainContainer.x = 0;
    mainContainer.y = 0;
    //基準点を画面の真中にする
    mainContainer.regX = -1 * canvasHalfWidth;
    mainContainer.regY = -1 * canvasHalfHeight;

    //mainContainerに入っているものを画面に表示させる
    stage.addChild(mainContainer);

    //ここに格納されたものを表示する
    var displayObj = new Array();
    displayObj[0] = new Array();
    displayObj[1] = new Array();
    displayObj[2] = new Array();
    displayObj[3] = new Array();
    displayObj[4] = new Array();

    //displayObjに格納されたものを表示させるための関数を定義
    function dispFunc() {
        for (i = 0; i < displayObj.length; i++) {
            for (j = 0; j < displayObj[i].length; j++) {
                mainContainer.addChild(displayObj[i][j]);
            }
        }
    }

    //円と円を結ぶための配列
    var lineList = new Array();
    var lineBox = new createjs.Container();
    mainContainer.addChild(lineBox);

    //tickHandler関数用の設定
    createjs.Ticker.setFPS(40);
    createjs.Ticker.addEventListener('tick', tickHandler);

    function tickHandler(event) {

        var aaa = displayObj.length;
        /*
       var lengthA = displayObj[0].length;
       var lengthB = displayObj[1].length;
       var lengthC = displayObj[2].length;
       console.log(lengthA + " is lengthA=============================-");
       console.log(lengthB + " is lengthB=============================-");
       console.log(lengthC + " is lengthC=============================-");
*/

        for (i = 0; i < aaa; i++) {
            for (k = 0; k < displayObj.length; k++) {
                if ((i != k) && (displayObj[i].length != 0) && (displayObj[k].length != 0)) {
                    var a = displayObj[i];
                    //console.log(a.test);
                    var b = displayObj[k];
                    //console.log(b.test);
                    checkOverlap(a, b);
                }
            }
        }

        mainContainer.removeChild(lineBox);
        lineBox.removeAllChildren();

        if ((lineList[1]) && (lineList[1].length == 2)) {
            var line = qDrawLine(lineList[1][0].x, lineList[1][0].y, lineList[1][1].x, lineList[1][1].y, lineList[1][0].color);
            line.alpha = 0.45;
            lineBox.addChild(line);
        }

        if ((lineList[2]) && (lineList[2].length == 2)) {
            var line = qDrawLine(lineList[2][0].x, lineList[2][0].y, lineList[2][1].x, lineList[2][1].y, lineList[2][0].color);
            line.alpha = 0.45;
            lineBox.addChild(line);
        }
        if ((lineList[3]) && (lineList[3].length == 2)) {
            var line = qDrawLine(lineList[3][0].x, lineList[3][0].y, lineList[3][1].x, lineList[3][1].y, lineList[3][0].color);
            line.alpha = 0.45;
            lineBox.addChild(line);
        }

        mainContainer.addChildAt(lineBox, 1);

        stage.update();
    }

    //categoryList.jsの各階層にレイヤープロパティを追加する
    for (i = 0; i < categoryList.length; i++) { //一階層目の要素(部署プロジェクトなど）の数だけ繰り返す
        categoryList[i].layer = 1; //一階層目の要素にlayerプロパティを追加し、１を設定
        //categoryList[i].line = null;
        if (categoryList[i].child) { //オブジェクトのchildプロパティが要素を持っていたら
            for (j = 0; j < categoryList[i].child.length; j++) { //二階層目の要素の数だけ繰り返す
                categoryList[i].child[j].layer = 2; //二階層目の要素にlayerプロパティを追加し、２を設定
                //categoryList[i].child[j].line = null;
                if (categoryList[i].child[j].child.length) {
                    for (k = 0; k < categoryList[i].child[j].child.length; k++) {
                        categoryList[i].child[j].child[k].layer = 3; //三階層目の要素にlayerプロパティを追加し、3を設定
                        //categoryList[i].child[j].child[k].line = null;
                        if (categoryList[i].child[j].child[k].child.length) {
                            for (l = 0; l < categoryList[i].child[j].child[k].child.length; l++) {　
                                categoryList[i].child[j].child[k].child[l].layer = 4; //四階層目の要素にlayerプロパティを追加し、4を設定//categoryList[i].child[j].child[k].child[l].line = null;
                            }
                        }
                    }
                }
            }
        }
    }

    //最初の円とテキストを描画
    var firstInfo = {};
    firstInfo.name = "Search";
    firstInfo.color = "#ef7362";
    firstInfo.layer = 0;

    var firstCircleTextList = new QdrawCircleAndText(0, 0, baseRadius, firstInfo);
    var mainCircle = firstCircleTextList[0];
    mainCircle.alpha = 0;
    qAppearObjectMax(mainCircle);

    var mainText = firstCircleTextList[1];
    mainText.alpha = 0;
    qAppearObjectMax(mainText);

    displayObj[0].push(mainCircle);
    displayObj[0].push(mainText);

    dispFunc();

    //円とイベントを関連付ける
    mainCircle.addEventListener('click', clickMouseEvent01);
    mainCircle.addEventListener('mouseover', jumpMode);
    mainCircle.addEventListener('mouseout', removeJumpMode);
    //mainText.addEventListener('click', clickMouseEvent01);

    var focusName;
    var focusRect;

    var jumpModeCircle01;
    var jumpModeCircle02;
    var jumpModeCircle03;

    function zoomUp(e) {
        console.log(e.target.textInfo);
        focusName = new createjs.Text(e.target.textInfo, "20px Century Gothic", "#FFFFFF");
        var focusNameWidth = focusName.getMeasuredWidth()
        focusName.x = e.target.x - focusNameWidth / 1;
        focusName.y = e.target.y;
        focusName.regX = focusName.getMeasuredWidth() / 2;
        focusName.regY = focusName.getMeasuredHeight() / 2;
        focusName.alpha = 0;
        createjs.Tween.get(focusName, {loop: false}).wait(100).to({x: e.target.x,alpha: 1}, 200, createjs.Ease.quartOut);

        focusRect = qDrawRect(e.target.x, e.target.y, focusName.getMeasuredWidth(), focusName.getMeasuredHeight(), e.target.color);
        focusRect.alpha = 0;
        var moveX = focusRect.x;
        focusRect.x = focusRect.x + focusRect.width;
        createjs.Tween.get(focusRect, {loop: false}).wait(100).to({x: moveX,alpha: 1}, 200, createjs.Ease.quartOut);
        mainContainer.addChild(focusRect);
        mainContainer.addChild(focusName);
        //stage.addChild(focusRect);
        //stage.addChild(focusName);
    }

    function zoomOut(e) {
        mainContainer.removeChild(focusName);
        mainContainer.removeChild(focusRect);
        //stage.removeChild(focusName);
        //stage.removeChild(focusRect);
        //createjs.Tween.get(mainText, {loop: false}).to({scaleX: 1.0, scaleY: 1.0,alpha: 1}, 200);
    }

    function jumpMode(e) {
        var radius = Math.floor(e.target.radius / 3);
        jumpModeCircle01 = qDrawLineCircle(e.target, radius);
        jumpModeCircle01.alpha = 1;
        jumpModeCircle01.scaleX = 0;
        jumpModeCircle01.scaleY = 0;
        createjs.Tween.get(jumpModeCircle01, {loop: true}).to({scaleX: 1.5,scaleY: 1.5,alpha: 0}, 900, createjs.Ease.quartOut).wait(600);
        mainContainer.addChild(jumpModeCircle01);

        jumpModeCircle02 = qDrawLineCircle(e.target, radius);
        jumpModeCircle02.alpha = 1;
        jumpModeCircle02.scaleX = 0;
        jumpModeCircle02.scaleY = 0;
        createjs.Tween.get(jumpModeCircle02, {loop: true}).wait(300).to({scaleX: 1.5,scaleY: 1.5,alpha: 0}, 900, createjs.Ease.quartOut).wait(300);
        mainContainer.addChild(jumpModeCircle02);

        jumpModeCircle03 = qDrawLineCircle(e.target, radius);
        jumpModeCircle03.alpha = 1;
        jumpModeCircle03.scaleX = 0;
        jumpModeCircle03.scaleY = 0;
        createjs.Tween.get(jumpModeCircle03, {loop: true}).wait(600).to({scaleX: 1.5,scaleY: 1.5,alpha: 0}, 900, createjs.Ease.quartOut);
        mainContainer.addChild(jumpModeCircle03);

    }

    function removeJumpMode(e) {
        mainContainer.removeChild(jumpModeCircle01);
        mainContainer.removeChild(jumpModeCircle02);
        mainContainer.removeChild(jumpModeCircle03);

    }

    function qDrawRect(x, y, width, height, color) {
        var g = new createjs.Graphics();
        g.beginStroke("rgba(100,255,70,0)");
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

    //マウスオーバー時に指差しカーソルにする
    mainCircle.cursor = "pointer";
    //円に情報を加える
    mainCircle.objInfo = categoryList;

    stage.update();

    //最初の円にだけ適用するクリックイベント
    function clickMouseEvent01(e) {

        //位置を初期化
        mainCircle.x = 0;
        mainCircle.y = 0;

        mainText.x = 0;
        mainText.y = 0;

        mainContainer.removeChild(lineBox);

        var groupObj = qDrawChildCircle(e.target);

        createjs.Tween.get(e.target, {loop: false}).to({scaleX: 1.4,scaleY: 1.4}, 300, createjs.Ease.quintOut)
                                                    .to({scaleX: 1.0,scaleY: 1.0}, 200);
        //allList.push(groupObj);
        //moveList.push(groupObj);
        //e.target.removeEventListener('click', clickMouseEvent01);
        dispFunc();
    }

    function clickMouseEvent02(e) {
        var groupObj = qDrawChildCircle(e.target);


        createjs.Tween.get(e.target, {loop: false}).to({scaleX: 1.4,scaleY: 1.4}, 300, createjs.Ease.quintOut)
                                                    .to({scaleX: 1.0,scaleY: 1.0}, 200);

        //これが中央へ移動する大きな塗りつぶしの円の移動量
        var xAdjust = -1 * groupObj[0].x;
        var yAdjust = -1 * groupObj[0].y;

        createjs.Tween.get(groupObj[0], {loop: false}).wait(300).to({x: 0,y: 0}, 800, createjs.Ease.backOut).call(qPriority(groupObj));

        createjs.Tween.get(groupObj[0], {loop: false}).wait(1800).call(qPriority(groupObj));

        for (i = 0; i < groupObj.length; i++) {
            var moveX = groupObj[i].x + xAdjust;
            var moveY = groupObj[i].y + yAdjust;
            createjs.Tween.get(groupObj[i], {loop: false}).wait(300).to({x: moveX,y: moveY}, 800, createjs.Ease.backOut);
        }

        //大きな円と大きな円をつなく線をつくる
        var elm = []; //配列をつくる
        elm[0] = e.target;　 //ひとつめの要素にクリックされた円を入れる
        elm[1] = groupObj[0]; //ふたつめの要素に大きな半透明の円を入れる

        //lineList.push(elm); //それらをlineList配列に追加する
        lineList[e.target.layerInfo] = elm;
        console.log("lineList[" + e.target.layerInfo + "]に格納しました＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝＝");
        //e.target.removeEventListener('click', clickMouseEvent01);

        dispFunc();

    }

    //直線を描画する関数
    function qDrawLine(x, y, toX, toY, color) {
        var shape = new createjs.Shape();
        shape.graphics.setStrokeStyle(4); //2
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

    //対象を1000ミリ秒かけて出現させる
    function qAppearObject(obj) {
        createjs.Tween.get(obj, {loop: false}).to({alpha: 0.2}, 1000);
    }

    //対象を1000ミリ秒かけてアルファ１００％で出現させる関数を定義
    function qAppearObjectMax(obj) {
        createjs.Tween.get(obj, {loop: false}).to({alpha: 1.0}, 1000);
    }

    function qAppearObjectTypeA(obj) {
        obj.alpha = 0;
        obj.scaleX = 1.5;
        obj.scaleY = 1.5;

        createjs.Tween.get(obj, {loop: false}).to({scaleX: 1.0,scaleY: 1.0,alpha: 0.8}, 200).to({alpha: 0.2}, 200);
    }

    function qAppearObjectTypeB(obj) {
        obj.alpha = 1;
        obj.scaleX = 0.0;
        obj.scaleY = 0.0;

        createjs.Tween.get(obj, {loop: false}).to({scaleX: 1.5,scaleY: 1.5,alpha: 0.0}, 400).to({alpha: 0.0}, 200);
    }


    function qPriority(groupObj) {
        groupObj[0].priority = 0;
        console.log("done!!");
    }


    //円とテキストを描画する関数を定義
    function QdrawCircleAndText(x, y, radiusNum, objInfo) {

        //円の文言を変数に格納
        var moji = objInfo.name;
        //円の色を変数に格納
        var colorcode = objInfo.color;
        //円をつくる
        var circle = new createjs.Shape();
        //塗りの色を設定
        circle.graphics.beginFill(colorcode);
        circle.color = colorcode;

        var red = colorcode.substr(1, 2);
        var green = colorcode.substr(3, 2);
        var blue = colorcode.substr(5, 2);

        red = parseInt(red, 16);
        green = parseInt(green, 16);
        blue = parseInt(blue, 16);

        var middleColor = "rgba(" + red + "," + green + "," + blue + ",0.6)"
        var endColor = "rgba(" + red + "," + green + "," + blue + ",0)"

        circle.graphics.beginRadialGradientFill([colorcode, middleColor, endColor], [0, 0.5, 1.0], 0, 0, 0, 0, 0, radiusNum);

        //線の色を設定
        circle.graphics.beginStroke("rgba(0,0,0,0)");
        //線の太さを設定
        circle.graphics.setStrokeStyle(1); //4
        //円を描画
        circle.graphics.drawCircle(x, y, radiusNum);
        //塗りの終了

        circle.graphics.endFill();　　　 //円の半径を設定
        circle.radius = radiusNum;　　　 //widthを設定
        circle.width = radiusNum * 2;
        //heightを設定
        circle.height = radiusNum * 2;
        circle.positionX = x;
        circle.positionY = y;

        //circleにlayer情報を加える
        circle.layerInfo = objInfo.layer;

        circle.textInfo = moji;
        circle.x = x;
        circle.y = y;

        circle.cache(x - radiusNum * 1.1, y - radiusNum * 1.1, radiusNum * 2.2, radiusNum * 2.2);

        //配列のなかに円とテキストを格納
        this[0] = circle;
        var text = new createjs.Text(moji, "13px Century Gothic", "#FFFFFF");

        text.hitArea = new createjs.Shape();　
        text.hitArea.graphics.f('white').dr(0, 0, text.getMeasuredWidth(), text.getMeasuredHeight());

        //textの基準点を設定
        text.regX = text.getMeasuredWidth() / 2;
        text.regY = text.getMeasuredHeight() / 2.5;
        this[1] = text;
        //text.cache(text.x * 1.1, text.y * 1.1, text.regX * 2.2, text.regY * 2.2);
    }

    //線状の円を描画する関数
    function qDrawLineCircle(obj, radiusNum) {

        //大きな線の円を描画
        var lineCircle = new createjs.Shape();
        lineCircle.graphics.beginStroke("#" + "FFFFFF");
        //線の太さを設定
        lineCircle.graphics.setStrokeStyle(1); //
        //円を描画
        lineCircle.graphics.drawCircle(0, 0, radiusNum * 3);
        //塗りの終了
        lineCircle.graphics.endFill();
        lineCircle.alpha = 0;
        lineCircle.stopPositionX = 0;
        lineCircle.stopPositionX = 0;
        lineCircle.x = obj.x;
        lineCircle.y = obj.y;
        lineCircle.width = 2 * radiusNum * 3;
        lineCircle.height = lineCircle.width;

        return lineCircle;
    }

    function jumpUrl(e) {
        //window.open(e.target.urlData);
        var url = e.target.urlData;
        location.href = url.toString();
        console.log(location.href);
    }

    //指定の数だけ子円をつくる関数
    function qDrawChildCircle(obj) {

        var list = [];　　　 //空のオブジェクト
        //作る子要素の数を設定
        num = obj.objInfo.length;
        var limitNum = num;
        //渡された円の半径
        var radiusNum = obj.radius;
        //円を2重に表示したりするために使用する変数
        var count = 0;
        //大きなぬりつぶしの円用の変数
        var maxRadius;
        maxRadius = radiusNum * (3 + 1);
        if (limitNum > 9) {
            maxRadius = radiusNum * (4.5 + 1);
        }

        //大きな線の円用の変数
        var lineCircleRadius01 = 0;
        var lineCircleRadius02 = 0;

        var layer = obj.layerInfo;
        console.log(layer + " is layer");

        //同階層の別サークルがクリックされたら、すでに展開しているサークルを消す処理
        if (displayObj[layer].length != 0) { //同じレイヤーにすでに表示しているものがあったら実行

            for (i = 0; displayObj[layer].length; i++) {

                //表示準備リストのなかを空にする
                displayObj[layer].splice(0, 1);
                //console.log(displayObj[layer].length);

                console.log("splice layer1");
            }

            if (lineList[layer]) {
                lineList[layer].splice(0, 2);
                console.log("lineList[" + layer + "]の中身を削除しました");
            }

            var layer2 = layer + 1;

            if (displayObj[layer2]) {
                for (i = 0; displayObj[layer2].length; i++) {
                    displayObj[layer2].splice(0, 1);
                    //console.log(displayObj[layer].length);
                    console.log("splice layer2");
                }

                if (lineList[layer2]) {
                    lineList[layer2].splice(0, 2);
                    console.log("lineList[" + layer2 + "]の中身を削除しました");
                }
            }

            var layer3 = layer2 + 1;

            if (displayObj[layer3]) {
                for (i = 0; displayObj[layer3].length; i++) {
                    displayObj[layer3].splice(0, 1);
                    //console.log(displayObj[layer].length);
                    console.log("splice layer3");
                }

                if (lineList[layer3]) {
                    lineList[layer3].splice(0, 2);
                    console.log("lineList[" + layer3 + "]の中身を削除しました");
                }
            }

            var layer4 = layer3 + 1;

            if (displayObj[layer4]) {
                for (i = 0; displayObj[layer4].length; i++) {
                    displayObj[layer4].splice(0, 1);
                    //console.log(displayObj[layer].length);
                    console.log("splice layer4");
                }

                if (lineList[layer4]) {
                    lineList[layer4].splice(0, 2);
                    console.log("lineList[" + layer4 + "]の中身を削除しました");
                }
            }

        }
        //表示しているものをすべて消す
        mainContainer.removeAllChildren();
        //displayObjに入っているものを表示させる　空なのですべて消える
        dispFunc();

        //大きな塗りつぶしの円の描画
        var bigCircle = new createjs.Shape();
        bigCircle.graphics.beginFill("rgba(0,39,49,1)");
        //線の太さを設定
        bigCircle.graphics.setStrokeStyle(1);
        //円を描画
        bigCircle.graphics.drawCircle(0, 0, maxRadius);
        //塗りの終了
        bigCircle.graphics.endFill();
        bigCircle.alpha = 0;
        bigCircle.stopPositionX = 0;
        bigCircle.stopPositionX = 0;
        bigCircle.x = obj.x;
        bigCircle.y = obj.y;
        console.log("bigCircle.x is " + bigCircle.x);
        console.log("bigCircle.y is " + bigCircle.y);
        bigCircle.width = 2 * maxRadius;
        bigCircle.height = bigCircle.width;
        //bigCircle.test = "test";
        bigCircle.circleFlag = 1;
        bigCircle.positionX = obj.x;
        bigCircle.positionY = obj.y;
        bigCircle.cache(0 - maxRadius * 1.1, 0 - maxRadius * 1.1, maxRadius * 2.2, maxRadius * 2.2);
        //半径プロパティをもたせる
        bigCircle.radius = maxRadius;
        displayObj[layer].push(bigCircle); //このbigCircleを配列の一番最初にいれないと衝突判定できないので注意
        qAppearObject(bigCircle);

        //大きな線の円を描画
        var biglineCircle01 = qDrawLineCircle(obj, radiusNum);
        //biglineCircle01.cache(biglineCircle01.x - biglineCircle01.width,biglineCircle01.y -biglineCircle01.height,biglineCircle01.width,biglineCircle01.height);
        displayObj[layer].push(biglineCircle01);
        qAppearObjectTypeA(biglineCircle01);

        //大きな線の円を描画
        var biglineCircle02 = qDrawLineCircle(obj, radiusNum);
        displayObj[layer].push(biglineCircle02);
        qAppearObjectTypeB(biglineCircle02);

        //子円が二重になったら大きな線の円ももう一つつくる
        if (lineCircleRadius02 != 0) {
            var biglineCircle02 = new createjs.Shape();
            biglineCircle02.graphics.beginStroke("#" + "FFFFFF");
            //線の太さを設定
            biglineCircle02.graphics.setStrokeStyle(1); //5
            //円を描画
            biglineCircle02.graphics.drawCircle(0, 0, lineCircleRadius02);
            //塗りの終了
            biglineCircle02.graphics.endFill();
            biglineCircle02.alpha = 0;
            biglineCircle02.stopPositionX = 0;
            biglineCircle02.stopPositionX = 0;
            biglineCircle02.x = obj.x;
            biglineCircle02.y = obj.y;

            displayObj[layer].push(biglineCircle02);
            qAppearObjectTypeA(biglineCircle02);
        }

        if (layer == 0) {
            displayObj[0].push(mainCircle);
            displayObj[0].push(mainText);
        }

        for (i = 0; i < num; i++) {
            //console.log(obj.objInfo[i].layer); //階層を出力

            list[i] = (i * 360 / num);
            var objList = new QdrawCircleAndText(0, 0, radiusNum, obj.objInfo[i]);
            var circle = objList[0];
            circle.cursor = "pointer";

            //circleの発生した位置をおぼえておく
            circle.birthPositionX = obj.x;
            circle.birthPositionY = obj.y;
            //circle.controlNumber = i;
            circle.objInfo = obj.objInfo[i].child;

            circle.x = obj.x;
            circle.y = obj.y;

            //透明にしておく
            circle.alpha = 0;
            circle.baseDegree = list[i];

            if (obj.objInfo[i].url != "") {
                console.log(obj.objInfo[i].url + obj.objInfo[i].name);
                var url = obj.objInfo[i].url;
                circle.urlData = url;
                console.log("つけました");
                circle.addEventListener('click', jumpUrl);
                circle.addEventListener('mouseover', jumpMode);
                circle.addEventListener('mouseout', removeJumpMode);
            } else {
                circle.urlData = "";
                console.log("つけませんでした");
                circle.addEventListener('click', clickMouseEvent02);
                circle.addEventListener('mouseover', zoomUp);
                circle.addEventListener('mouseout', zoomOut);
            }

            toX = circle.x + (radiusNum * 3 * Math.cos(Math.PI / 180 * list[i]));
            toY = circle.y + (radiusNum * 3 * Math.sin(Math.PI / 180 * list[i]));
            lineCircleRadius01 = circle.x + radiusNum * 3;
            maxRadius = radiusNum * (3 + 1);

            circle.stopPositionX = toX;
            circle.stopPositionY = toY;

            if (limitNum > 9) {
                var judge = count % 2;
                console.log(judge);
                lineCircleRadius02 = radiusNum * 4.5;
                maxRadius = +radiusNum * (4.5 + 1);
                if (judge == 0) {
                    toX = circle.x + Math.floor(radiusNum * 4.5 * Math.cos(Math.PI / 180 * list[i]));
                    toY = circle.y + Math.floor(radiusNum * 4.5 * Math.sin(Math.PI / 180 * list[i]));

                } else {
                    toX = circle.x + (radiusNum * 3 * Math.cos(Math.PI / 180 * list[i]));
                    toY = circle.y + (radiusNum * 3 * Math.sin(Math.PI / 180 * list[i]));
                }
            }
            //円を2重に表示したりするために使用する変数
            count++;

            var lineObj = qDrawLine(obj.x, obj.y, toX, toY, "#FFF");
            displayObj[layer].push(lineObj);
            console.log("lineObjをdisplayObj[" + layer + "]に格納しました");

            qAppearObject(lineObj);

            qTweenFromCenter(circle, toX, toY);

            circle.x = toX;
            circle.y = toY;

            //circleを表示させるためdisplayObjに格納
            displayObj[layer].push(circle);
            console.log("circleをdisplayObj[" + layer + "]に格納しました");

            //テキストの描画
            var text = objList[1];
            displayObj[layer].push(text);
            console.log("textをcircleをdisplayObj[" + layer + "]に格納しました");
            text.alpha = 0;
            qAppearObjectMax(text);
            text.x = toX;
            text.y = toY;

            text.positionX = circle.x;
            text.positionY = circle.y;
        }

        return displayObj[layer];
    }

    //トゥイーンさせる関数
    function qTweenFromCenter(obj, toX, toY) {
        createjs.Tween.get(obj, {loop: false}).to({x: toX,y: toY,scaleX: 0.8,scaleY: 0.8,alpha: 1}, 300, createjs.Ease.backOut);
    }

    function checkOverlap(containerObject1, containerObject2) {

        var obj1 = containerObject1[0];
        var obj2 = containerObject2[0];

        var xDifference = Math.floor(obj1.x - obj2.x);
        var yDifference = Math.floor(obj1.y - obj2.y);
        var distance = Math.floor(Math.sqrt(Math.pow(xDifference, 2) + Math.pow(yDifference, 2))); //2円間の距離
        var totalRadius = Math.floor(obj1.radius + obj2.radius); //2円の半径の合計
        var moveNum = Math.abs(distance - totalRadius); //重なっている長さ

        var radian = Math.floor(Math.atan2(yDifference, xDifference));

        if (distance <= totalRadius) {

            console.log("衝突してます");

            var addNum = 7; //調整用 3

            var xJudge = obj1.x - obj2.x;
            var yJudge = obj1.y - obj2.y;

            if (xJudge < 0) {
                var addX = Math.floor(Math.cos(Math.PI / 180 * radian) * moveNum / 2);

                if (containerObject1[0].x > xLeftLimit) { //左側の限界を超えていなかったら実行

                    for (i = 0; i < containerObject1.length; i++) {
                        containerObject1[i].x -= addX + addNum;
                    }

                } else if ((containerObject1[0].y > yTopLimit) && (containerObject1[0].y < yBottomLimit)) {

                    for (i = 0; i < containerObject1.length; i++) {
                        containerObject1[i].y -= 1;
                    }

                }

                for (i = 0; i < containerObject2.length; i++) {
                    containerObject2[i].x += addX + addNum;
                }

            }

            if (yJudge < 0) {
                var addY = Math.floor(Math.sin(Math.PI / 180 * radian) * moveNum);

                if (containerObject1[0].y > yTopLimit) { //上側の限界を超えていなかったら実行

                    for (i = 0; i < containerObject1.length; i++) {
                        containerObject1[i].y -= addY + addNum;
                    }

                } else if ((containerObject1[0].x > xLeftLimit) && (containerObject1[0].x < xRightLimit)) {

                    for (i = 0; i < containerObject1.length; i++) {
                        containerObject1[i].x += 1;
                    }

                }

                for (i = 0; i < containerObject2.length; i++) {
                    containerObject2[i].y += addY + addNum;
                }
            }

            if (xJudge > 0) {
                var addX = Math.floor(Math.cos(Math.PI / 180 * radian) * moveNum / 2);

                if (containerObject1[0].x < xRightLimit) {

                    for (i = 0; i < containerObject1.length; i++) {
                        containerObject1[i].x += addX + addNum;
                    }

                } else if ((containerObject1[0].y > yTopLimit) && (containerObject1[0].y < yBottomLimit)) {
                    for (i = 0; i < containerObject1.length; i++) {
                        containerObject1[i].y += 1;
                    }
                }
                for (i = 0; i < containerObject2.length; i++) {
                    containerObject2[i].x -= addX + addNum;
                }
            }

            if (yJudge > 0) {
                var addY = Math.floor(Math.sin(Math.PI / 180 * radian) * moveNum);

                if (containerObject1[0].y < yBottomLimit) {

                    for (i = 0; i < containerObject1.length; i++) {
                        containerObject1[i].y += addY + addNum;
                    }

                } else if ((containerObject1[0].x > xLeftLimit) && (containerObject1[0].x < xRightLimit)) {

                    for (i = 0; i < containerObject1.length; i++) {
                        containerObject1[i].x += 1;
                    }

                }

                for (i = 0; i < containerObject2.length; i++) {
                    containerObject2[i].y -= addY + addNum;
                }
            }

        }

    }

})