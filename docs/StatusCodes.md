# Status Codes

A list of valid status responses from the `TimelineAPI` See [error handling](http://developer.getpebble.com/guides/timeline/timeline-public/#error-handling) for more information

| Code                  | Status                                                    |
| ----                  | :----:                                                    |
| `200`                 | Success!                                                  |
| `400`                 | The pin object submitted was invalid.                     |
| `403`                 | The API key submitted was invalid.                        |
| `410`                 | The user token submitted was invalid or does not exist.   |
| `429`                 | Server is sending updates too quickly.                    |
| `503`                 | Could not save pin due to a temporary server error.       |

Any other status codes will return `Illegal response code.`