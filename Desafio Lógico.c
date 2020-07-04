#include <stdio.h>

int main(void) {
  
  int dimensao;
  printf("Entre com a dimensão da sua matriz quadrada (Ex.: 3): \n");
  scanf("%d", &dimensao);
  int matriz[dimensao][dimensao];
  int i, j;
  
  printf("Entre com os números da Matriz:\n");
  for(i = 0; i < dimensao; i++){
    for(j = 0; j < dimensao; j++){
      scanf("%d", &matriz[i][j]);
    }
  }

  printf("\nMatriz Criada: \n\n");

  for(i = 0; i < dimensao; i++){
    for(j = 0; j < dimensao; j++){
      printf("%d ", matriz[i][j]);
    }
    printf("\n");
  }
  
  int diagonais[2] = {0,0};
  for(i = 0; i < dimensao; i++){
    diagonais[0] += matriz[i][i];
    diagonais[1] += matriz[i][(dimensao-1)-i];
  }
  

  printf("Soma Diagona Principal: %d \n", diagonais[0]);
  printf("Soma Diagona Secundária: %d\n", diagonais[1]);
  
  system("pause");
  return 0;
}

