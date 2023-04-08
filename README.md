## Introduction

This is an example to review how we can create objects to be used in our unit tests.

We will see three different ways to create new entities to be used in our tests.

The first one it will be the classic one. Create an object using the entity as usual

The second one is using ObjectMother basically is using the same behaviour than in the previous version but using factory methods to have all the possible entities in only way place.

The third one is using data builder. Using reflection we are able to build the entity that we need for our tests. On this version we will work on an improvement using PHP magic methods to avoid a lot of repetitive work in our data builders

## Makefile

There is a Makefile with two method to run this code. Build and test. The test method will run all the tests with the different version that we commented previously.