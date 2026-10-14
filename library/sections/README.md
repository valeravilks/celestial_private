# Sections

Секции — готовые композиции блоков в виде WordPress patterns. Каждая секция размещается в отдельном каталоге:

```text
sections/<section>/
├── description.md
└── pattern.php
```

Создавать описание по [шаблону секции](../templates/section.md). Указывать назначение, состав, поля содержимого, зависимости от style variations и ограничения композиции.

Секция использует стабильный slug style variation, например `subtitle`. Не требовать конкретную библиотечную реализацию dot/line без реальной композиционной необходимости. Если такая зависимость есть, явно описать её до выбора секции для проекта.

В проект переносятся только выбранные patterns и необходимые зависимости. Другие секции остаются в библиотеке. Синхронизированные patterns требуют отдельного процесса создания и переноса; обычный файл pattern.php сам по себе не обеспечивает синхронизацию экземпляров.

Секции:

- [Header: Site Title и Navigation](header-title-navigation/description.md) — название слева, меню справа; начальная реализация.

- [Footer: Copyright](footer-copyright/description.md) — название проекта и год.

## Переиспользуемые секции

- [Hero: заголовок и две кнопки](hero-intro/description.md) — категория `hero`.
- [Benefits: три преимущества](benefits-three-columns/description.md) — категория `benefits`.
- [Features: состав предложения](features-three-columns/description.md) — категория `features`.
- [Process: три этапа](process-three-steps/description.md) — категория `process`.
- [FAQ: вопросы и ответы](faq-text/description.md) — категория `faq`.
- [Contact: приглашение к разговору](contact-intro/description.md) — категория `contact`.

- [Информационная секция: шесть пунктов с иконками](information-six-items/description.md) — категория features.
