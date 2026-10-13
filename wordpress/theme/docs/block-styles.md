# Дополнительные CSS-файлы блоков

Базовые свойства и токены задаются в `theme.json`, визуальные варианты блоков — в JSON style variations. Если для оформления нужны сложные селекторы, состояния, media queries или анимации, использовать отдельный готовый CSS-файл. Сборка темы не требуется.

## Подключение CSS

Функция `celestial_theme_register_block_styles()` в `functions.php` на хуке `init` вызывает `wp_enqueue_block_style()` для перечисленных Core-блоков.

```text
button → core/button → assets/blocks/button.css → celestial-button
```

Сейчас в списке только `button`. Файл `assets/blocks/button.css` пустой: это точка расширения без новых визуальных правил. `group` из старого проекта не подключён, пока у него нет собственного CSS-файла.

## Добавление блока

1. Создать `assets/blocks/<block-name>.css`, например `group.css`.
2. Добавить имя без `core/` в `$styled_blocks` в `functions.php`:

   ```php
   $styled_blocks = array( 'button', 'group' );
   ```

3. Использовать токены темы и ограничить селекторы нужным блоком или style variation.
4. Проверить оформление в редакторе и на сайте, включая состояния и мобильную ширину.

`src` задаёт URL файла, `path` — его локальный путь для оптимизации загрузки WordPress. Файл связывается с блоком; конкретный способ загрузки или встраивания CSS определяется WordPress и текущим контекстом рендера.

## CSS и style variations

Подключение CSS не регистрирует новый визуальный вариант в редакторе. Для варианта сначала требуется отдельная регистрация, например JSON с `blockTypes`, `slug`, `title` и `styles` в `styles/blocks/<block-name>/`.

Дополнительный CSS ограничивать классом варианта и нужным внутренним элементом. Например, для будущего варианта `button-link`:

```css
.wp-block-button.is-style-button-link .wp-element-button::after {
  content: '→';
  margin-inline-start: var(--wp--preset--spacing--20);
}
```

Это пример для будущей реализации: сейчас `button-link` не зарегистрирован, правило не добавлено в `button.css`. Не дублировать в CSS цвета, размеры и отступы, которые уже корректно определены JSON. При анимации учитывать `prefers-reduced-motion`.
