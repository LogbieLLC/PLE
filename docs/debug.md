# PLE System Debug Features

## Time Restriction Override

The system normally restricts inspections to between 12:00 AM and 7:00 AM. For testing purposes, this restriction can be disabled using the `PLE_DEBUG` environment variable.

### Usage

Set the environment variable before starting the application:

```bash
# Enable debug mode (disables time restriction)
export PLE_DEBUG=true

# Disable debug mode (enforces time restriction)
export PLE_DEBUG=false  # or unset PLE_DEBUG
```

### Implementation Details

- Debug mode is controlled by the `PLE_DEBUG` environment variable
- When enabled, the time restriction check is bypassed
- The current system time is still displayed for reference
- Debug status is available in templates via the `debugMode` variable

### Security Considerations

- Debug mode should only be enabled in development/testing environments
- Production deployments should never have `PLE_DEBUG` set to true
- The environment variable must be explicitly set; defaults to false
