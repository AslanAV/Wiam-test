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
    <hr>
    <div class="m-2">
        <p>Setup and start project</p>
        <code class="lang-shell">
            ./deploy.<span class="hljs-keyword">sh</span>
        </code>
    </div>
    <div class="m-3"></div>
    <div class="m-2">
        <p>add migration</p>
        <code class="lang-shell">
            <span class="hljs-attribute">make compose-bash</span>
        </code>
    </div>
    <div class="m-3"></div>
    <div class="m-2">
        <p>in docker-container</p>
        <code class="lang-shell">
            ./yii migrate
        </code>
    </div>
    <div class="m-3"></div>
    <div class="m-2">
        <p>Site</p>
        <code class="lang-shell"><span class="hljs-symbol">
             http:</span><span class="hljs-comment">//localhost/</span>
        </code>
    </div>
    <div class="m-3"></div>
    <div class="m-2">
        <p>Admin with token=xyz123</p>
        <code class="lang-shell">http:<span class="hljs-regexp">
                //</span>localhost<span class="hljs-regexp">/web/i</span>ndex.php?r=site%<span class="hljs-number">2</span>Fadmin&amp;token=xyz123<span class="hljs-regexp">/</span>
        </code>
    </div>
    <div class="m-3"></div>
</div>
