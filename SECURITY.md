Security Policy

Purpose of This File

This document explains how to report genuine issues in VulnLab.

Important: VulnLab is an intentionally vulnerable application. The four known vulnerabilities — SQL Injection, XSS, OS Command Injection, and Unrestricted File Upload — are features, not bugs. Please read the README before reporting anything.

Supported Versions

Version              Status
v1.1-patched         Patched — accepts genuine issue reports
v1.0-vulnerable      Vulnerable — educational reference, no fixes accepted

Anything older than v1.0 is not supported.

Reporting a Genuine Issue

A "genuine issue" is something that is NOT one of the four intentional vulnerabilities. Examples:

- A setup step in the README that does not work
- A typo or broken link in the documentation
- A bug in the patched branch (main) where a fix is incomplete
- A problem with the lab environment: log forwarding, SIEM ingestion, or detection setup

To report it, open an Issue on GitHub and include:

1. A clear description of the problem
2. Steps to reproduce it
3. The branch you are on (main or vulnerable)
4. The affected file(s)
5. Logs or screenshots if applicable

What This Policy Does Not Cover

- The four intentional vulnerabilities, in any branch
- Any consequence of exploiting them
- Misuse of the application by third parties

For everything else — legal terms, ethical use, copyright, and contact details — refer to the README file. This policy only covers reporting.
