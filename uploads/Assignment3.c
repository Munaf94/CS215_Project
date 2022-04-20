//CS330 - Assignment 3  - Question 2
//Name:Munafbhai Umatiya
//student Id:200439752

#include <semaphore.h>
#include <stdlib.h>
#include <stdio.h>
#include <unistd.h>
#include <pthread.h>
#include <sys/wait.h>
#include <sys/types.h>
#include <errno.h>

//some constant global varibles
#define NUM 5
#define THINKING 0
#define HUNGRY 1
#define EATING 2
//left and right variables determing philospers at left and right
#define LEFT (Number+4)%NUM
#define RIGHT (Number+1)%NUM

int state[NUM];
sem_t mutex;
sem_t sample[NUM];

void * Philosopher_1(void * number);
void take_stick(int);
void put_stick(int);
void check(int);


void * Philosopher_1(void * Number)
{
  while(1)
  {
    int* x=Number;
    sleep(1);
    take_stick(*x);
    sleep(2);
    put_stick(*x);
  }
}

//prompts philosopher to take adjacent sticks to eat after fulfilling conditions.

void take_stick(int Number)
{
  sem_wait(&mutex);
  state[Number]=HUNGRY;
  check(Number);
  sem_post(&mutex);
  sleep(1);
}
//checks if philosophers on adjacent are eating, else assigns eating status to hungry philosopher
void check(int Number)
{
  if(state[Number]  == HUNGRY && state[LEFT]!= EATING && state[RIGHT]!=EATING)
  {
    state[Number] = EATING;
    sleep(2);
    printf("\nCurrently Philosopher [%i]  => eating", Number);
    sem_post(&sample[Number]);
  }
}

//prompts philosopher to kee its left and right stick after eating
void put_stick(int Number)
{
  sem_wait(&mutex);
  state[Number] = THINKING;
  printf("\nCurrently  philosopher [%i]  => thinking ", Number);
  check(LEFT);
  check(RIGHT);
  sem_post(&mutex);
}

int array1[NUM]={1,2,3,4,5};


int main()
{
  
  pthread_t thread_id[NUM];
  sem_init(&mutex,0,1);
  int i=0;
  while(i<NUM)
  {
    sem_init(&sample[i],0,0);
    i++;
  }
  for(i=0;i<NUM;i++)
  {
    pthread_create(&thread_id[i],NULL, Philosopher_1,&array1[i]);
    printf("\nCurrently  Philosopher [%d] => Thinking!", i+1);
  }

  //use to get value returned by a thread and also blocking another thread
  for( i=0;i<NUM;i++)
  {
    pthread_join(thread_id[i], NULL);
  }
  
}


