import pandas as pd
import sys
import json

def movie_info(): 
    movie_id = int(sys.argv[1])

    movie_df = pd.read_csv(r'/Applications/XAMPP/xamppfiles/htdocs/bfi-user-study/csv/cleaned_movies.csv')
    movie = movie_df[movie_df.movie_id == movie_id]
    movie = movie.to_json()
    movie = json.loads(movie)
    return json.dumps(movie)


if __name__ == "__main__":
    print(movie_info())