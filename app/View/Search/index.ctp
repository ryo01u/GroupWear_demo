<?php echo $this->element('header'); ?>
<?php echo $this->element('head'); ?>
<?php echo $this->element('navi'); ?>


<div class="bass_maincontents_01">
    <div class="container keyword">
        <div class="row">
            <p class="bass_title_03">キーワード検索</p>
        </div>
        <form>
            <div class="search_wrap">
                <div class="row text_input_wrap">
                    <div class="col-sm-10 col-xs-10 text_input">
                        <input name="data[Staff][password]" type="password" id="StaffPassword">
                    </div>

                    <div class="col-sm-2 col-xs-2 serch_btn">
                        <input type="submit" value="検索">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <span class="serch_toggle">▼さらに細かく<span>
                    </div>
                </div>
                <div class="serch_area">
                    <div class="row">
                        <div class="col-sm-12">
                            <p>検索対象</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <label><input type="checkbox">スタッフ</label>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label><input type="checkbox">取引先</label>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label><input type="checkbox">案件</label>
                        </div>
                    </div>
                </div>

                <div class="serch_area">
                    <div class="row">
                        <div class="col-sm-12">
                            検索対象
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 col-xs-6">
                            <label><input type="checkbox">モバイル事業部</label>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label><input type="checkbox">ソリューション事業部</label>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label><input type="checkbox">メディアビジネス部</label>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label><input type="checkbox">イノベーティブビジネス部
                            </label>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label><input type="checkbox">技術統括部</label>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label><input type="checkbox">マーケ&ampPR室</label>
                        </div>
                        <div class="col-sm-3 col-xs-6">
                            <label><input type="checkbox">総務部</label>
                        </div>
                    </div></div>


                <div class="row table_opt">
                    <div class="col-sm-2 no_all">
                        全2件
                    </div>
                    <div class="col-sm-3 col-xs-6">
                        <select >
                            <option>名前(昇順)</option>
                        </select>
                    </div>
                    <div class="col-sm-4 col-xs-6">
                        <select >
                            <option>全て</option>
                        </select>
                    </div>
                </div>
                </form>
                <table cellspacing="0" cellpadding="0" border="0" class="tbl-search">
                    <tr>
                        <th></th>
                        <th>名前</th>
                        <th>種別</th>
                        <th>部署</th>
                        <th>グループ</th>
                        <th>担当</th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>写真</td>
                        <td>トロの電卓</td>
                        <td>スタッフ</td>
                        <td><a>ソリューション事業部</a></td>
                        <td>開発グループ</td>
                        <td><a>森</a><a>辻</a></td>
                        <td>
                           <div class="btn_cell">
                            <span class="bass_btn">
                                <input type="submit" value="詳細">
                            </span>
                            <span class="bass_btn">
                                <input type="submit" value="ホーム&#13;&#10;へ追加">
                            </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>写真</td>
                        <td>トロの電卓</td>
                        <td>スタッフ</td>
                        <td><a>ソリューション事業部</a></td>
                        <td>開発グループ</td>
                        <td><a>森</a><a>辻</a></td>
                        <td>
                            <div class="btn_cell">
                            <span class="bass_btn">
                                <input type="submit" value="詳細">
                            </span>
                            <span class="bass_btn">
                                <input type="submit" value="ホーム&#13;&#10;へ追加">
                            </span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>写真</td>
                        <td>トロの電卓</td>
                        <td>スタッフ</td>
                        <td><a>ソリューション事業部</a></td>
                        <td>開発グループ</td>
                        <td><a>森</a><a>辻</a></td>

                        <td>
                            <div class="btn_cell">
                            <span class="bass_btn">
                                <input type="submit" value="詳細">
                            </span>
                            <span class="bass_btn off">
                                <input type="submit" value="ホーム&#13;&#10;へ追加">
                            </span>
                            </div>
                        </td>
                    </tr>
                </table>


            </div>

    </div><!--class="container"-->
</div>


  <?php echo $this->element('footer'); ?>

