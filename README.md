<p align="center">
    <h1 align="center">README</h1>
    </p>
    
<h4>Реализованная функциональность</h4>
<ul>
    <li>Регистрация;</li>
   <li>Подтверждение почты;</li>
    <li>Авторизация;</li>
    <li>Сброс пароля;</li>
  <li>Полнотекстовой живой поиск;</li>
	<li>Учет опечаток;</li>
 <li>Фильтры по категориям;</li>
 <li>Отображение карточек (краткой информации) с Infinite scroll;</li>
 <li>Отображение подробной информации;</li>
</ul> 
<h4>Особенность проекта в следующем:</h4>
<ul>
 <li>Полнотекстовой живой поиск (прямо как в Google, ищет сразу во всех полях и релевантно располагает стартапы);</li>
 <li>Мастер-фильтр, поможет настроить фильтрацию в соответсвии в запросами заказчика в простой форме;</li>
 </ul>
<h4>Основной стек технологий:</h4>
<ul>
	<li>HTML, CSS, Sass, JavaScript.</li>
   <li>Vue.js, Nuxt.js, Axios.</li>
	<li>PHP 8, MySQL.</li>
	<li>Laravel.</li>
	<li>Algolia.</li>
	<li>Webpack.</li>
 <li>Git, GitHub.</li>
  
 </ul>
<h4>Демо</h4>
<p>Демо сервиса доступно по адресу: http://innocase.cyberbobs.xsph.ru/ </p>
<p>Чтобы зайти под тестовым пользователем, нажмите на кнопку, ниже кнопки входа.</p>




СРЕДА ЗАПУСКА
------------
1) <b>Frontend:</b> требуется установленный web-сервер с поддержкой Node.Js(версия 12+) интерпретации (apache, nginx);
2) <b>Backend:</b> требуется установленный web-сервер с поддержкой PHP(версия 7.4+) интерпретации (apache, nginx);
3) требуется установленная СУБД MySQL (версия 8);


УСТАНОВКА
------------
### Установка Backend

Установка зависимостей осуществляется с помощью [Composer](http://getcomposer.org/). Если у вас его нет вы можете установить его по инструкции
на [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

Также, необходимо провести настройку файла окружения, .env, необходимо задать следущие параметры
1) Параметры подключение к БД (DB_CONNECTION,DB_HOST,DB_PORT,DB_DATABASE,DB_USERNAME,DB_PASSWORD)
2) Параметры подключения к почтовому серверу SMTP (MAIL_HOST,MAIL_PORT,MAIL_USERNAME,MAIL_PASSWORD,MAIL_ENCRYPTION,MAIL_FROM_ADDRESS)
3) Параметры подключения к ALGOLIA (ALGOLIA_APP_ID, ALGOLIA_SECRET). [Регистрация](https://www.algolia.com/users/sign_up)
4) Адрес (APP_URL)

Выполнить следущие команды из папки inno-api
~~~
composer install
php artisan jwt:secret
php artisan migrate:refresh --seed
php artisan serve
~~~

### База данных

База данных вместе с тестовыми данными создается при установки бекенда, однако, можно использовать готовый [скрипт создания базы данных с структурой и тестовыми данными](https://raw.githubusercontent.com/TTepel7/INNO-ShowCase/main/Database.sql)


### РАЗРАБОТЧИКИ

<h4>Пепелышев Дмитрий Backend</h4>
<h4>Нестеров Александр Frontend</h4>

