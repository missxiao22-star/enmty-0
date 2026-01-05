			<div class="di"
				style="height:540px; border:#999 1px solid; width:53.2%; margin:2px 0px 0px 0px; float:left; position:relative; left:20px;">
				<marquee scrolldelay="120" direction="left" style="position:absolute; width:100%; height:40px;">
                   <?php
                        $ads=$Ad->all(['sh'=>1]);
                        foreach($ads as $ad){
                            echo $ad['text']."&nbsp;&nbsp;&nbsp;&nbsp;";
                        }
                   ?> 
                </marquee>
				<div style="height:32px; display:block;"></div>
				<!--正中央-->
				<script>
					var lin = new Array();
					<?php
                        $mvims=$Mvim->all(['sh =>1']);
                        foreach($muims as $mv){
                            echo "lin.push ('upload/{$mv['img']}');\n";
                    }
                    // 目前題目在前端這邊寫的是jq語法，
                    // 若是要將要顯示的動畫顯示在首頁瀏覽器就需要用jq寫
                    // 在jq的寫法會是下方這樣，但因為要將PHP功能寫進來，所以造一個字串讓它呈現出jq的語句
                    // lin.push ('upload/{$mv['img']}');\n"
                    ?>
                    var now = 0;
                    ww()
					if (lin.length > 1) {
						setInterval("ww()", 3000);
						now = 1;
					}
					function ww() {
						$("#mwww").html("<embed loop=true src='" + lin[now] + "' style='width:99%; height:100%;'></embed>")
						//$("#mwww").attr("src",lin[now])
						now++;
						if (now >= lin.length)
							now = 0;
					}
				</script>
				<div style="width:100%; padding:2px; height:290px;">
					<div id="mwww" loop="true" style="width:100%; height:100%;">
						<div style="width:99%; height:100%; position:relative;" class="cent">
                            <!-- embed 儲存路徑 -->
                            <embed loop=true src='" + lin[now] + "' style='width:99%; height:100%;'></embed>
                        </div>
					</div>
				</div>
				<div
					style="width:95%; padding:2px; height:190px; margin-top:10px; padding:5px 10px 5px 10px; border:#0C3 dashed 3px; position:relative;">
					<span class="t botli">最新消息區
                        <?php
                        //使用$News物件計算news資料表裡面欄位sh為1的所有資料，如果資料大於5
                        if($News->count(['sh'=>1])>5){
                            //就在瀏覽器顯示a標籤
                            echo "<a herf='?do=news' style='float:right;'>More...</a>";
                        }
                        ?>
					</span>
                        <?php
                        //使用$News物件抓取所有news資料表內欄位sh為1的資料，最多顯示5筆
                        $news=$News->all(['sh'=>1],"limit 5")
                        ?>
					<ul class="ssaa" style="list-style-type:decimal;">
                        <?php
                        //用迴圈跑news資料表內的所有資料並存到$n內
                        foreach($news as $n){
                            //在網頁顯示標籤格式，依照標籤格式顯示
                            echo "<li>";
                            //在網頁顯示，使用mb_substr方法，讓$n讀取到的news資料表內的欄位text資料(字串)斷行
                            echo mb_substr($n['text'],0,20);
                            echo "<div class='all' style='display:none;'>";
                            echo $n['text'];
                            echo "</div>";
                            echo "</li>";
                        }
                        ?>
					</ul>
					<div id="altt"
						style="position: absolute; width: 350px; min-height: 100px; background-color: rgb(255, 255, 204); top: 50px; left: 130px; z-index: 99; display: none; padding: 5px; border: 3px double rgb(255, 153, 0); background-position: initial initial; background-repeat: initial initial;">
					</div>
					<script>
						$(".ssaa li").hover(
							function () {
								$("#altt").html("<pre>" + $(this).children(".all").html() + "</pre>")
								$("#altt").show()
							}
						)
						$(".ssaa li").mouseout(
							function () {
								$("#altt").hide()
							}
						)
					</script>
				</div>
			</div>