<!DOCTYPE html>
<html>
<head>
	<meta charset=utf-8>
	<title>はじめてのcanvas</title>
	<style>
		#mycanvas{
			border:1px solid gray;
			background-color:white;
		}
	</style>
</head>
<body>

	<canvas id=mycanvas width=400 height=400>
		canvas対応のブラウザでご覧下さい
	</canvas>
	
		<!-- ここにJavaScript のコードを書きましょう -->
	<script>
		var canvas = document.getElementById("mycanvas");
		var c = canvas.getContext("2d");
		
			// グー
			playerImage(50, 360);
			TextDisplay("グー",30,370);	
	
			// チョキ
			playerImage(200, 360);
			TextDisplay("チョキ",175,370);		
	
			// パー
			playerImage(350, 360);
			TextDisplay("パー",330,370);	

			// じゃんけんの手
			TextDisplay("Player:",30,200);	// 味方の手
			TextDisplay("Enemy:",230, 200); // 敵の手

			// ポイント
			TextDisplay("ポイント:",150,50);	
			var point = 0;

			/*
			関数
			*/
			// プレイヤーの手を表示する。
			function playerText(playerPoint) {
				c.fillStyle = "black";
				c.font = "20px sans-serif ";
				c.fillText(playerPoint,100,200);
			}

			// 敵の手を計算する
			function enemyText() {
				var enemy = Math.floor(Math.random()*3);
				c.fillStyle = "black";
				c.font = "20px sans-serif ";
				if (enemy == 0) {
					c.fillText("グー", 305,200);
					return enemy;
				} else if (enemy == 1) {
					c.fillText("チョキ", 305,200);
					return enemy;
				} else if (enemy == 2) {
					c.fillText("パー", 305,200);
					return enemy;
				}
			}

			// プレイヤー画像
			function playerImage(x, y) {
				c.beginPath();
				c.arc(x,y,30,0,2*Math.PI,false);
				c.fillStyle= "red";
				c.fill();
			}

			// プレイヤー画像のテキスト
			function TextDisplay(text,x,y) {
				c.fillStyle = "black";
				c.font = "18px sans-serif ";
				c.fillText(text, x, y)
			}

			// クリックイベント
			canvas.onmousedown = (function(e) {
				var rect = e.target.getBoundingClientRect(); // キャンバスの位置を取得
				
				var mx = e.clientX - rect.left;
				var my = e.clientY - rect.top;

				var enemy = 0; // 初期化

				// クリア
				c.clearRect(100,175,70,30);  // 味方の手
				c.clearRect(300,175,70,30);  // 敵の手
				c.clearRect(150,80,160,30);  // 結果
				
				console.log(mx);
				console.log(my);
				console.log(Math.floor(Math.random()*3));

				// グーのクリック判定
				if((20 <=mx)&&(mx <=80)) {
					if(330 <= my && (my <=390)) {
						var player = 0;
						playerText("グー");
						enemy = enemyText();
					}
				}
				// チョキのクリック判定
				if((170 <=mx)&&(mx <=230)) {
					if(330 <= my && (my <=390)) {
						var player = 1;
						playerText("チョキ");
						enemy = enemyText();
					}
				}
				// パーのクリック判定
				if((320 <=mx)&&(mx <=380)) {
					if(330 <= my && (my <=390)) {
						var player = 2;
						playerText("パー");
						enemy = enemyText();
					}
				}

				// 判定
				// グーの場合
				if (player == 0 && enemy == 0 ) {
					TextDisplay("あいこです。",150,100);	
				} else if (player == 0 && enemy == 1) {
					TextDisplay("あなたの勝ちです。",150,100);	
					c.clearRect(230,30,50,30);   // ポイント 
					TextDisplay(++point, 240,50);
				} else if (player == 0 && enemy == 2) {
					TextDisplay("あなたの負けです。",150,100);	
				} 

				// チョキの場合
				if (player == 1 && enemy == 0) {
					TextDisplay("あなたの負けです。",150,100);	
				} else if (player == 1 && enemy == 1) {
					TextDisplay("あいこです。",150,100);
				} else if (player == 1 && enemy == 2) {
					TextDisplay("あなたの勝ちです。",150,100);
					c.clearRect(230,30,50,30);   // ポイント 
					TextDisplay(++point, 240,50);
				} 

				// パーの場合
				if (player == 2 && enemy == 0) {
					TextDisplay("あなたの勝ちです。",150,100);
					c.clearRect(230,30,50,30);   // ポイント 
					TextDisplay(++point, 240, 50);
				} else if (player == 2 && enemy == 1) {
					TextDisplay("あなたの負けです。",150,100);	
				} else if (player == 2 && enemy == 2) {
					TextDisplay("あいこです。",150,100);
				}
				
			});

	</script>
</body>
</html>