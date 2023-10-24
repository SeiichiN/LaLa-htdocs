<aside>
  <h2>サブメニュー</h2>
  <form method="post" action="">
    <input type="number" name="min_age">歳〜
    <input type="number" name="max_age">歳 <br>
    <label><input type="radio" name="sex" value="m">男性</label>
    <label><input type="radio" name="sex" value="f">女性</label><br>
    <input type="submit" value="選択">
  </form>
  <form method="post" action="search.php">
    <input type="text" name="search" placeholder="文字">
    <input type="submit" value="検索">
  </form>
</aside>