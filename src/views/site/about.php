<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h2 id="-wiam-group">Тестовое WIAM group</h2>
    <h3 id="-yii2-docker-compose-">Создать проект на yii2 с использованием docker-compose.</h3>
    <ul>
        <li><p>в папке с проектом должен быть скрипт deploy.sh, который разворачивает готовый к работе локальный сайт (должен заработать на linux).</p>
        </li>
        <li><p>БД - PostgreSQL</p>
        </li>
        <li>сервер - nginx</li>
    </ul>
    <h4 id="-">Структура</h4>
    <ul>
        <li><p>главная страница</p>
            <ul>
                <li><p>на странице появляется рандомная фотография с сайта <a href="https://picsum.photos/">https://picsum.photos/</a></p>
                </li>
                <li><p>фото получается по url <a href="https://picsum.photos/id/1020/600/500">https://picsum.photos/id/1020/600/500</a>
                        где:
                        1020 - в url это id фотки
                        600 и 500 - это размеры фотки (неважно какие)</p>
                </li>
                <li><p>под фотографией располагаются 2 кнопки: отклонить и одобрить.
                        при нажатии на любую из кнопок соответствующий запрос отправляется на сервер асинхронно.</p>
                </li>
                <li><p>затем появляется новая фотография и так по кругу.</p>
                </li>
                <li><p>фотографии по которым было принято решение больше не показываются.</p>
                </li>
            </ul>
        </li>
        <li><p>админская страница</p>
            <ul>
                <li><p>доступ к странице предоставляется только при наличии токена xyz123 в get параметре.</p>
                </li>
                <li><p>на странице выводится таблица со следующими столбцами:</p>
                    <ul>
                        <li>id фотографии который является ссылкой на эту фотографию.</li>
                        <li>решение - одобрена или отклонена.</li>
                        <li>кнопка отмены решения (можно синхронно).</li>
                    </ul>
                </li>
            </ul>
        </li>
    </ul>
    <p>Setup and start project</p>
    <pre><code class="lang-shell">./deploy.<span class="hljs-keyword">sh</span>
</code></pre>
    <p>Site</p>
    <pre><code class="lang-shell"><span class="hljs-symbol">http:</span><span class="hljs-comment">//localhost/</span>
</code></pre>
</code></pre>
    <p>Admin with token xyz123</p>
    <pre><code class="lang-shell"><span class="hljs-symbol">http:</span><span class="hljs-comment">//localhost/web/index.php?r=site%2Fadmin&token=xyz123/</span>
</code></pre>

</div>
