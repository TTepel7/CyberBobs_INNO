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
	<li>Algoria.</li>
	<li>Webpack.</li>
 <li>Git, GitHub.</li>
  
 </ul>
<h4>Демо</h4>
<p>Демо сервиса доступно по адресу: http://innocase.cyberbobs.xsph.ru/ </p>
<p>Чтобы зайти под тестовым пользователем, нажмите на кнопку, ниже кнопки входа.</p>




СРЕДА ЗАПУСКА
------------
1) <b>Frontend:</b> требуется установленный web-сервер с поддержкой PHP(версия 7.4+) интерпретации (apache, nginx);
2) <b>Backend:</b> требуется установленный web-сервер с поддержкой PHP(версия 7.4+) интерпретации (apache, nginx);
3) требуется установленная СУБД MariaDB (версия 10+);


УСТАНОВКА
------------
### Установка Backend

Выполнить следущие команды из папки inno-api
~~~
composer install
sudo apt-get upgrade
sudo apt-get install name1
sudo apt-get install mariadb-client mariadb-server
git clone https://github.com/Sinclear/default_readme
cd default_readme
...
~~~
### База данных

Необходимо создать пустую базу данных, а подключение к базе прописать в конфигурационный файл сервиса по адресу: папка_сервиса/...
~~~
sudo systemctl restart mariadb
sudo mysql_secure_installation
mysql -u root -p
mypassword
CREATE DATABASE mynewdb;
quit
~~~
### Выполнение миграций

Для заполнения базы данных системной информацией выполните в корневой папке сервиса: 
~~~
mysql -u root -p -f mynewdb < папка_сервиса/...
mypassword
~~~
и согласитесь с запросом

### Установка зависимостей проекта

Установка зависимостей осуществляется с помощью [Composer](http://getcomposer.org/). Если у вас его нет вы можете установить его по инструкции
на [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

После этого выполнить команду в директории проекта:

~~~
composer install
~~~

РАЗРАБОТЧИКИ

<h4>Пепелышев Дмитрий Backend</h4>
<h4>Нестеров Александр Frontend</h4>

