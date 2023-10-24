<article>
  <h2>一覧</h2>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>名前</th>
        <th>年齢</th>
        <th>性別</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($result as $row) : ?>
        <tr>
          <td><?= h($row['id']) ?></td>
          <td><?= h($row['name']) ?></td>
          <td><?= h($row['age']) ?></td>
          <td><?= h($row['sex']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</article>