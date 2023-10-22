<aside>
  <ul>
    <li>
      <form method="post" action="">
        年齢:
        <select name="age">
          <option value="20">20〜29</option>
          <option value="30">30〜39</option>
          <option value="40">40〜</option>
        </select>
        <input type="submit" value="確定">
      </form>
    </li>
    <li>
      <form method="post" action="">
        <input type="radio" name="sex" value="m">男性
        <input type="radio" name="sex" value="f">女性<br>
        <?php if (isset($age)) : ?>
          <input type="hidden" name="age" value="<?= $age ?>">
        <?php endif; ?>
        <input type="submit" value="性別で絞込">
      </form>
    </li>
    <li>
      <form method="post" action="">
        <input type="text" name="sql" placeholder="SQL文"><br>
        <input type="submit" value="このSQLで実行">
      </form>
    </li>
    <li>
      <form method="post" action="">
        <input type="text" name="search" placeholder="文字">
        <input type="submit" value="検索">
      </form>
    </li>
  </ul>
</aside>