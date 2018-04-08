<?php

return [
		'user-management' => [		'title' => 'Управление',		'created_at' => 'Время',		'fields' => [		],	],
		'permissions' => [		'title' => 'Разрешения',		'created_at' => 'Время',		'fields' => [			'title' => 'Название',		],	],
		'roles' => [		'title' => 'Роли',		'created_at' => 'Время',		'fields' => [			'title' => 'Название',			'permission' => 'Разрешения',		],	],
		'users' => [		'title' => 'Пользователи',		'created_at' => 'Время',		'fields' => [			'name' => 'Имя',			'email' => 'Email',			'password' => 'Пароль',			'role' => 'Роль',			'remember-token' => 'Remember token',		],	],
		'courses' => [		'title' => 'Курсы',		'created_at' => 'Время',		'fields' => [			'teachers' => 'Учитель',			'title' => 'Название',			'slug' => 'Slug',			'description' => 'Описание',			'price' => 'Цена',			'course-image' => 'Изображение',			'start-date' => 'Начало',			'published' => 'Опубликовать',		],	],
		'lessons' => [		'title' => 'Уроки',		'created_at' => 'Время',		'fields' => [			'course' => 'Предмет',			'title' => 'Название',			'slug' => 'Slug',			'lesson-image' => 'Изображение',			'short-text' => 'Краткое описание',			'full-text' => 'Полное описание',			'position' => 'Позиция',			'downloadable-files' => 'Загрузить файлы',			'free-lesson' => 'Free lesson',			'published' => 'Опубликовать',		],	],
		'questions' => [		'title' => 'Вопросы',		'created_at' => 'Время',		'fields' => [			'question' => 'Вопрос',			'question-image' => 'Изображение',			'score' => 'Балл',		],	],
		'questions-options' => [		'title' => 'Варианты ответов',		'created_at' => 'Время',		'fields' => [			'question' => 'Вопрос',			'option-text' => 'Вариант ответа',			'correct' => 'Правильно',		],	],
		'tests' => [		'title' => 'Тесты',		'created_at' => 'Время',		'fields' => [			'course' => 'Предмет',			'lesson' => 'Урок',			'title' => 'Название',			'description' => 'Описание',			'questions' => 'Вопросы',			'published' => 'Опубликовать',		],	],
	'app_create' => 'Создать',
	'app_save' => 'Сохранить',
	'app_edit' => 'Редактировать',
	'app_view' => 'Просмотр',
	'app_update' => 'Обновить',
	'app_list' => 'Список',
	'app_no_entries_in_table' => 'Нет записей в таблице',
	'custom_controller_index' => 'Индекс пользовательского контроллера',
	'app_logout' => 'Выйти',
	'app_add_new' => 'Добавить',
	'app_are_you_sure' => 'Вы уверены?',
	'app_back_to_list' => 'Вернуться к списку',
	'app_dashboard' => 'Главная',
	'app_delete' => 'Удалить',
	'global_title' => 'Панель',
];