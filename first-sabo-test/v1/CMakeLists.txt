cmake_minimum_required(VERSION 3.13)

set(CMAKE_BUILD_TYPE Debug)

project(sabo)

add_subdirectory(src/commands/commands)
add_subdirectory(src/utils)

set(APP src/sabo.c)

add_executable(sabo ${APP})

target_link_libraries(sabo COMMANDS UTILS)
