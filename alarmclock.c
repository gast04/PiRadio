#include <stdio.h>
#include <time.h>

int main (int argc, char** argv)
{

  int clock_hours = atoi(argv[1]);
  int clock_mins = atoi(argv[2]);

//  printf("%d \n", clock_hours);
//  printf("%d \n", clock_mins);

  time_t rawtime;
  struct tm * timeinfo;

  time ( &rawtime );
  timeinfo = localtime ( &rawtime );
  int time_hours = timeinfo->tm_hour;
  int time_mins = timeinfo->tm_min;
  int time_secs = timeinfo->tm_sec;

  while(1){

   time ( &rawtime );
   timeinfo = localtime ( &rawtime );
   time_hours = timeinfo->tm_hour;
   time_mins = timeinfo->tm_min;
   time_secs = timeinfo->tm_sec;

 //printf ( "local time: %d : %d : %d \n", time_hours, time_mins, time_secs ); 

   if ( clock_hours == time_hours && clock_mins == time_mins){
  //  printf("ALARM\n");
   	break;
   }
   sleep(30);
  }
/*
  printf ( "Current local time and date: %d : %d \n", timeinfo->tm_hour,timeinfo->tm_min );

  time_t mytime;
  mytime = time(NULL);
  printf(ctime(&mytime));
*/
  return 0;
}