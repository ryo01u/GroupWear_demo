window.onload = function() {

    var canvasWidth = $(window).width();
    var canvasHeight = $(window).height();

    //ステージオブジェクトをつくる
    var stage = new createjs.Stage("myCanvas");
    var canvas = document.getElementById("myCanvas");

    //キャンバスのサイズをウインドウのサイズと同じにする
    canvas.width = document.body.clientWidth;
    canvas.height = document.body.clientHeight;
    //キャンバスタグの幅と高さ、それぞれの半分の値を変数に格納
    var canvasHalfWidth = canvas.width / 2;
    var canvasHalfHeight = canvas.height / 2;

    var baseRadius = canvas.width / 40; //キャンバスの幅の30分の1のサイズ

    //コンテナ
    var mainContainer = new createjs.Container();
    mainContainer.x = 0;
    mainContainer.y = 0;
    //基準点を画面の真中にする
    mainContainer.regX = -1 * canvasHalfWidth;
    mainContainer.regY = -1 * canvasHalfHeight;

    stage.addChild(mainContainer);

    var allList = new Array();
    var moveList = new Array();

    var lineList = new Array();
    var lineBox = new createjs.Container();
    mainContainer.addChild(lineBox);

    var firstInfo = {};
    firstInfo.name = "Search";
    firstInfo.color = "#ef7362";
    //最初の円を描画
    var firstCircleTextList = new QdrawCircleAndText(0, 0, baseRadius, firstInfo);
    var mainCircle = firstCircleTextList[0];
    mainContainer.addChild(mainCircle);

    //円とイベントを関連付ける
    mainCircle.addEventListener('click', clickMouseEvent01);
    //円に情報を加える
    mainCircle.objInfo = categoryList;

    var mainText = firstCircleTextList[1];
    mainContainer.addChild(mainText);


    function qDrawRect(x, y, width, height) {
        var g = new createjs.Graphics();
        g.beginFill("#353332");
        g.setStrokeStyle(1);
        g.drawRect(x, y, width, height);
        var s = new createjs.Shape(g);
        s.regX = width / 2;
        s.regY = height / 2;
        s.width = width;
        s.height = height;
        return s;
    }

    var bgRect = qDrawRect(0, 0, canvasWidth, canvasHeight);
    mainContainer.addChildAt(bgRect, 0);

    function startDrag(eventObject) {
        var instance = eventObject.target;
        instance.addEventListener("pressmove", drag);
        instance.addEventListener("pressup", stopDrag);
    }

    function drag(eventObject) {
        var instance = eventObject.target;
        var oldX = instance.x;
        var oldY = instance.y;
        instance.x = eventObject.stageX - canvasWidth / 2;
        instance.y = eventObject.stageY - canvasHeight / 2;

        console.log(eventObject.target.prototype + "aaaaaaaaaaaaaaaa");

        stage.update();
    }

    function stopDrag(eventObject) {
        var instance = eventObject.target;
        instance.removeEventListener("pressmove", drag);
        instance.removeEventListener("pressup", stopDrag);
    }

    //円（とテキスト）をつくる関数を定義
    function QdrawCircleAndText(x, y, radiusNum, objInfo) {

        //円の文言を変数に格納
        var moji = objInfo.name;
        //円の色を変数に格納
        var colorcode = objInfo.color;
        //円をつくる
        var circle = new createjs.Shape();
        //塗りの色を設定
        circle.graphics.beginFill(colorcode);
        //線の色を設定
        circle.graphics.beginStroke("#333333");
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

        circle.x = x;
        circle.y = y;

        circle.cache(x - radiusNum * 1.1, y - radiusNum * 1.1, radiusNum * 2.2, radiusNum * 2.2);

        //配列のなかに円とテキストを格納
        this[0] = circle;
        var text = new createjs.Text(moji, "14px Century Gothic", "#FFFFFF");
        //textの基準点を設定

        text.regX = text.getMeasuredWidth() / 2;
        text.regY = text.getMeasuredHeight() / 2.5;
        this[1] = text;

        text.cache(text.x * 1.1, text.y * 1.1, text.regX * 2.2, text.regY * 2.2);
    }

    //最初の円にだけ適用
    function clickMouseEvent01(e) {
        var groupObj = qDrawChildCircle(e.target);
        groupObj.list.push(e.target);
        groupObj.list.push(mainText);
        //allList.push(groupObj);
        moveList.push(groupObj);
        e.target.removeEventListener('click', clickMouseEvent01);
    }

    function qPriority(groupObj) {
        groupObj.moveObject.priority = 0;
        console.log("done!!");
    }

    function clickMouseEvent02(e) {

        e.target.removeEventListener('click', clickMouseEvent02);

        var groupObj = qDrawChildCircle(e.target);
        //moveList[0] = groupObj;
        moveList.push(groupObj);
        //allList.push(groupObj);

        //これが中央へ移動する大きな塗りつぶしの円の移動量
        var xAdjust = -1 * groupObj.moveObject.x;
        var yAdjust = -1 * groupObj.moveObject.y;

        createjs.Tween.get(groupObj.moveObject, {
            loop: false
        }).wait(400).to({
            x: 0,
            y: 0
        }, 1400, createjs.Ease.backOut).call(qPriority(groupObj));

        createjs.Tween.get(groupObj.moveObject, {
            loop: false
        }).wait(1800).call(qPriority(groupObj));


        for (i = 0; i < groupObj.list.length; i++) {
            var moveX = groupObj.list[i].x + xAdjust;
            var moveY = groupObj.list[i].y + yAdjust;
            createjs.Tween.get(groupObj.list[i], {
                loop: false
            }).wait(400).to({
                x: moveX,
                y: moveY
            }, 1400, createjs.Ease.backOut);
        }

        var elm = [];
        elm[0] = e.target;
        elm[1] = groupObj.moveObject;
        lineList.push(elm);

        console.log(elm[0].x + "======================xxxxxxxxxxxxxxxx");
        console.lgo(elm[1].x + "----------------------yyyyyyyyyyyyy");

    }

    function jumpUrl(e) {
        window.open(e.target.urlData);
    }

    //指定の数だけ子円をつくる関数
    function qDrawChildCircle(obj) {　 //円の角度格納用
        var list = [];　　　 //空のオブジェクト
        var groupObj = {};
        //circleやtextやlineを格納する用
        groupObj.list = [];
        //大きなぬりつぶしの円を格納する用
        groupObj.moveObject;
        //groupObj.list.push(obj);
        //num = 7;
        num = obj.objInfo.length;

        var limitNum = num;
        //渡された円の半径
        var radiusNum = obj.radius;
        //円を2重に表示したりするために使用する変数
        var count = 0;
        //大きなぬりつぶしの円用の変数
        var maxRadius;
        //大きな線の円用の変数
        var lineCircleRadius01 = 0;
        var lineCircleRadius02 = 0;

        //var randomAngle = Math.floor(Math.random()*17) - 8;
        var randomAngle = 0;

        for (i = 0; i < num; i++) {

            list[i] = (i * 360 / num) + randomAngle;
            var objList = new QdrawCircleAndText(0, 0, radiusNum, obj.objInfo[i]);
            var circle = objList[0];
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
            } else {
                circle.urlData = "";
                console.log("つけませんでした");
                circle.addEventListener('click', clickMouseEvent02);
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
            groupObj.list.push(lineObj);
            mainContainer.addChild(lineObj);
            mainContainer.addChildAt(lineObj, 1);

            qAppearObject(lineObj);

            qTweenFromCenter(circle, toX, toY);

            circle.x = toX;
            circle.y = toY;

            groupObj.list.push(circle);
            mainContainer.addChild(circle);

            //テキストの描画
            var text = objList[1];
            //text.controlNumber = i;
            groupObj.list.push(text);
            mainContainer.addChild(text);
            text.alpha = 0;
            qAppearObjectMax(text);
            text.x = toX;
            text.y = toY;

            text.positionX = circle.x;
            text.positionY = circle.y;
        }

        //大きな塗りつぶしの円の描画
        var bigCircle = new createjs.Shape();
        bigCircle.graphics.beginFill("rgba(119,114,111,1)");
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
        bigCircle.width = 2 * maxRadius;
        bigCircle.height = bigCircle.width;
        bigCircle.test = "test";
        bigCircle.positionX = obj.x;
        bigCircle.positionY = obj.y;

        bigCircle.cache(0 - maxRadius * 1.1, 0 - maxRadius * 1.1, maxRadius * 2.2, maxRadius * 2.2);

        //bigCircle.addEventListener("mousedown", startDrag);

        //半径プロパティをもたせる
        bigCircle.radius = maxRadius;
        //優先順位をつけるためのプロパティ
        bigCircle.priority = 1;
        console.log("bigCircle.radius is " + bigCircle.radius);

        groupObj.moveObject = bigCircle;
        //groupObj.moveObject.addEventListener("mousedown,startDrag");
        mainContainer.addChild(bigCircle);
        mainContainer.addChildAt(bigCircle, 1);

        qAppearObject(bigCircle);

        //大きな線の円を描画
        var biglineCircle01 = new createjs.Shape();
        biglineCircle01.graphics.beginStroke("#" + "FFFFFF");
        //線の太さを設定
        biglineCircle01.graphics.setStrokeStyle(1); //
        //円を描画
        biglineCircle01.graphics.drawCircle(0, 0, radiusNum * 3);
        //塗りの終了
        biglineCircle01.graphics.endFill();
        biglineCircle01.alpha = 0;
        biglineCircle01.stopPositionX = 0;
        biglineCircle01.stopPositionX = 0;
        biglineCircle01.x = obj.x;
        biglineCircle01.y = obj.y;
        biglineCircle01.width = 2 * radiusNum * 3;
        biglineCircle01.height = biglineCircle01.width;

        //biglineCircle01.cache(biglineCircle01.x - biglineCircle01.width,biglineCircle01.y -biglineCircle01.height,biglineCircle01.width,biglineCircle01.height);
        groupObj.list.push(biglineCircle01);
        mainContainer.addChild(biglineCircle01);
        mainContainer.addChildAt(biglineCircle01, 1);
        qAppearObject(biglineCircle01);

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
            groupObj.list.push(biglineCircle02);
            mainContainer.addChild(biglineCircle02);
            mainContainer.addChildAt(biglineCircle02, 1);
            qAppearObject(biglineCircle02);
        }

        return groupObj;
    }

    createjs.Ticker.setFPS(25);
    createjs.Ticker.addEventListener('tick', tickHandler);

    function tickHandler(event) {

        var aaa = moveList.length;
        //console.log(aaa + "========================");

        //console.log("done");
        for (i = 0; i < aaa; i++) {
            for (k = 0; k < moveList.length; k++) {
                if (i != k) {
                    var a = moveList[i];
                    //console.log(a.test);
                    var b = moveList[k];
                    //console.log(b.test);
                    checkOverlap(a, b);
                }
            }
        }

        mainContainer.removeChild(lineBox);
        lineBox.removeAllChildren();
        for (i = 0; i < lineList.length; i++) {
            if (lineList.length >= 1) {
                var line = qDrawLine(lineList[i][0].x, lineList[i][0].y, lineList[i][1].x, lineList[i][1].y, "#00aeff");
                line.alpha = 0.3;
                lineBox.addChild(line);
            }

        }
        mainContainer.addChild(lineBox);

        stage.update();

    }

    function checkOverlap(containerObject1, containerObject2) {

        //obj2が逃げる側
        var obj1 = containerObject1.moveObject;
        var obj2 = containerObject2.moveObject;

        var xDifference = Math.floor(obj1.x - obj2.x);
        var yDifference = Math.floor(obj1.y - obj2.y);
        var distance = Math.floor(Math.sqrt(Math.pow(xDifference, 2) + Math.pow(yDifference, 2))); //2円間の距離
        var totalRadius = Math.floor(obj1.radius + obj2.radius); //2円の半径の合計
        var moveNum = Math.abs(distance - totalRadius); //重なっている長さ

        var radian = Math.floor(Math.atan2(yDifference, xDifference));
        console.log(radian + " radian");
        /*
        console.log("xDifference is " + xDifference);
        console.log("yDifference is " + yDifference);
        console.log("distance is " + distance);
        console.log("moveNum is " + moveNum);
        console.log("totalRadius is " + totalRadius);
		*/
        if (distance <= totalRadius) {

            console.log("衝突してます");

            var addNum = 7; //調整用 3

            var xJudge = obj1.x - obj2.x;
            var yJudge = obj1.y - obj2.y;

            if (xJudge < 0) {
                var addX = Math.floor(Math.cos(Math.PI / 180 * radian) * moveNum / 2);
                obj1.x -= addX + addNum;
                obj2.x += addX + addNum;

                for (i = 0; i < containerObject1.list.length; i++) {
                    containerObject1.list[i].x -= addX + addNum;
                }
                for (i = 0; i < containerObject2.list.length; i++) {
                    containerObject2.list[i].x += addX + addNum;
                }
            }

            if (yJudge < 0) {
                var addY = Math.floor(Math.sin(Math.PI / 180 * radian) * moveNum);
                obj1.y -= addY + addNum;
                obj2.y += addY + addNum;

                for (i = 0; i < containerObject1.list.length; i++) {
                    containerObject1.list[i].y -= addY + addNum;
                }
                for (i = 0; i < containerObject2.list.length; i++) {
                    containerObject2.list[i].y += addY + addNum;
                }
            }

            if (xJudge > 0) {
                var addX = Math.floor(Math.cos(Math.PI / 180 * radian) * moveNum / 2);
                obj1.x += addX + addNum;
                obj2.x -= addX + addNum;

                for (i = 0; i < containerObject1.list.length; i++) {
                    containerObject1.list[i].x += addX + addNum;
                }
                for (i = 0; i < containerObject2.list.length; i++) {
                    containerObject2.list[i].x -= addX + addNum;
                }
            }

            if (yJudge > 0) {
                var addY = Math.floor(Math.sin(Math.PI / 180 * radian) * moveNum);
                obj1.y += addY + addNum;
                obj2.y -= addY + addNum;

                for (i = 0; i < containerObject1.list.length; i++) {
                    containerObject1.list[i].y += addY + addNum;
                }
                for (i = 0; i < containerObject2.list.length; i++) {
                    containerObject2.list[i].y -= addY + addNum;
                }
            }

        }

    }

    function qTweenFromCenter(obj, toX, toY) {
        createjs.Tween.get(obj, {
            loop: false
        }).to({
            x: toX,
            y: toY,
            scaleX: 0.8,
            scaleY: 0.8,
            alpha: 1
        }, 300, createjs.Ease.backOut);
    }

    //直線を描画する関数
    function qDrawLine(x, y, toX, toY, color) {
        var shape = new createjs.Shape();
        shape.graphics.setStrokeStyle(1); //2
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
        createjs.Tween.get(obj, {
            loop: false
        }).to({
            alpha: 0.3
        }, 1000);
    }

    //対象を1000ミリ秒かけて出現させる
    function qAppearObjectMax(obj) {
        createjs.Tween.get(obj, {
            loop: false
        }).to({
            alpha: 1.0
        }, 1000);
    }

    stage.update();
}