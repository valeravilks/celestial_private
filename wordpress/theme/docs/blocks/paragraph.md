# Celestial — Block Paragraph

Правила стилизации стандартного WordPress блока `core/paragraph`.

Paragraph — базовый блок основного текстового контента. Он использует стабильные типографические значения и не должен получать случайные настройки из админки.

## Где создавать настройки в `theme.json`

Типографика paragraph наследуется из глобального `styles.typography`. Цвет также наследуется глобально из `styles.color.text`, где используется токен `contrast`:

```json
{
  "styles": {
    "typography": {
      "fontFamily": "var:preset|font-family|ubuntu",
      "fontSize": "var:preset|font-size|md",
      "fontWeight": "var:custom|font-weight|regular",
      "lineHeight": "var:custom|line-height|normal"
    }
  }
}
```

## Default Mapping

| Элемент | Font Family | Font Size | Font Weight | Line Height |
|---|---|---|---:|---:|
| Paragraph | `ubuntu` | `md` | `400` | `normal` |

`md` соответствует `1rem`, то есть примерно `16px` при стандартном размере шрифта браузера.

## Общие правила

1. Основной paragraph использует семейство `ubuntu`.
2. Базовый размер paragraph — `md`; для второстепенного текста используются отдельные роли `sm` и metadata/helper text.
3. Основной вес — `regular`, а line-height — `normal`.
4. Длинный текст должен сохранять достаточную читаемость и не сжиматься за счёт слишком маленького line-height.
5. В паттернах не задаются случайные размеры, веса или inline-стили.
6. HTML-структура текста не должна заменяться заголовком ради визуального увеличения размера.

## Editor Controls

Controls дизайна скрыты глобально по [общей политике](../editor-controls.md), без settings.blocks overrides.

## Secondary Text

Для metadata, helper text и других второстепенных текстовых ролей следует использовать отдельные элементы или style variations только при подтверждённой потребности:

```text
Основной paragraph       → md / regular / normal
Secondary paragraph     → sm / regular / normal
Lead paragraph           → lg / regular / relaxed
```

Такие роли не должны превращаться в отдельные токены компонентов. Они используют существующие Font Size и Line Height tokens.

## Style Variations

Альтернативная variation paragraph добавляется только для повторяющегося визуального сценария, например `lead` или `muted`.

Новая variation должна быть зарегистрирована как block style variation, а затем стилизована через `theme.json`. Паттерны используют variation вместо локальных CSS-значений.

```text
Paragraph block
├── default → основной текст
├── lead    → увеличенный вводный текст, если потребуется
└── muted   → второстепенный текст, если потребуется
```

Варианты `lead` и `muted` пока являются возможными ролями, а не обязательными зарегистрированными variations.

## Что не добавляется

- отдельные токены `paragraph-md`, `paragraph-sm` и подобные имена;
- произвольные размеры текста внутри паттернов;
- отдельный шрифт для каждого текстового сценария;
- слишком маленький line-height для экономии места;
- новая variation для единичного случая.

## Текущая реализация

Типографика наследуется из общих правил темы. Настройки дизайна скрыты глобально по [политике редактора](../editor-controls.md). Цвет текста по умолчанию contrast; блоковые overrides не используются. Дополнительные variations пока не зарегистрированы.
