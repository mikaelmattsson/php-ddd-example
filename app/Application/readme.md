
This is the application layer: code that's needed for the application to
performs its tasks. It defines, or is defined by, use cases.

It is thin in terms of knowledge of domain business logic,
although it may be large in terms of lines of code.
It coordinates the domain layer objects to perform the actual tasks. 

This layer is suitable for spanning transactions, security checks and high-level logging.

Source: https://github.com/citerus/dddsample-core/blob/master/src/main/java/se/citerus/dddsample/application/package.html
